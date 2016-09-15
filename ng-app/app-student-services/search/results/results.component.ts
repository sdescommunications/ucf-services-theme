import { Component, OnInit, OnChanges, Input, Output, EventEmitter, ChangeDetectorRef } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";

// import { SearchService } from "app-student-services/search";
import { SearchService } from "../service";
import { IStudentServiceSummary } from "../../../app-student-services/interfaces";
import { UnescapeHtmlPipe } from "../../../pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-results",
    moduleId: __moduleName,
    templateUrl: "./results.component.html",
    // styleUrls: ["../../scss/_service.scss"],
    // directives: [],
    // pipes: [ UnescapeHtmlPipe ],
})
export class SearchResultsComponent {
    @Input() query: string;
    @Input() api: string = "";
    @Input() filters: any = {};
    filterClear = () => jQuery.map( this.filters, (cat) => cat.checked ).every( (x) => "false" === x )
    @Input("results") studentServices: IStudentServiceSummary[] = window.ucf_searchResults_initial;
    errorMessage: string = "";
    isInit: boolean = true;
    isLoading: boolean = false;
    isLoadingMore = false;
    canLoadMore = true;

    protected _previousQuery: string;

    @Output() resultsChanged: EventEmitter<any> = new EventEmitter<any>();

    constructor( protected _searchService: SearchService, protected _detector: ChangeDetectorRef ) {
        window.ucf_comp_searchResults = ( window.ucf_comp_searchResults || [] ).concat( this );
    }

    ngOnInit(): void {
        // jQuery('#services>.student_service-list').hide();
        // Search sevice called by OnChanges when initializing.
        this._searchService.restApiUrl = this.api;
    }

    ngOnChanges(): void {
        this._searchService.restApiUrl = this.api;
        if ( this.query === this._previousQuery && ! this.isInit ) { return; } // Prevent loop between events this.resultsChanged() <-> SearchFormComponent.search()
        this.isLoading = ( this.isInit ) ? false : true;  // Don't show loading text on initial load.
        // TODO: observe this.query instead of creating a new subscription on every change.
        this._searchService.getStudentServices( this.query )
            .subscribe(
                studentServices => {
                    this._previousQuery = this.query;
                    this.studentServices = studentServices;
                    this.resultsChanged.emit( { query: this.query, results: this.studentServices } );
                    this.isLoading = false;
                    this.canLoadMore = true;
                },
                error => this.errorMessage = <any>error
            );
        this.isInit = false;
    }

    showNextPage( click: Event ): void {
        click.preventDefault();
        this.isLoadingMore = true;  // Track state instead of figuring out how to debounceWithSelector.
        this._searchService.getNextPage()
            .subscribe(
                nextPageResults => {
                    this.isLoadingMore = false;
                    if ( null === nextPageResults ) {
                        this.canLoadMore = false;
                        return;
                    }
                    this.studentServices = this.studentServices.concat( nextPageResults );
                    // Force Angular to detect changes.
                    this._detector.detectChanges();
                    this.resultsChanged.emit( { query: this.query, results: this.studentServices } );
                },
                error => this.errorMessage = <any>error
            );
    }

    hasResults(): boolean {
        return null !== this.studentServices;
    }

    clearResults(): void {
        this.query = "";
        this.studentServices = window.ucf_searchResults_initial;
        this.resultsChanged.emit( { query: this.query, results: this.studentServices } );
    }

    shouldFilter( categoryName ): boolean {
        if ( "undefined" === typeof categoryName ) { return false; }
        return this.filterClear() ||
            ( this.filters[categoryName]
              && "true" === this.filters[categoryName].checked );
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;  // Shim for SystemJS/ES6 module identification.
// Window from tsserver/lib.d.ts
interface WindowUcfComp extends Window {
    ucf_comp_searchResults: SearchResultsComponent[];
    ucf_searchResults_initial: IStudentServiceSummary[];
}
declare var window: WindowUcfComp;
