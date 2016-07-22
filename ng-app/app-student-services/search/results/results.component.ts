import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";

import { SearchService } from "app-student-services/search";
import { IStudentService } from "app-student-services/interfaces";
import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-results",
    moduleId: __moduleName,
    templateUrl: "./results.component.html",
    // templateUrl: "./results._template.php",
    // styleUrls: ["../../scss/_service.scss"],
    // directives: [],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchResultsComponent {
    @Input() query: string;
    @Input() api: string = "";
    studentServices: IStudentService[] = window.ucf_searchResults_initial;
    errorMessage: string = "";
    isInit: boolean = true;
    isLoading: boolean = false;

    @Output() resultsChanged: EventEmitter<any> = new EventEmitter<any>();

    constructor( protected _searchService: SearchService ) {
        window.ucf_comp_searchResults = ( window.ucf_comp_searchResults || [] ).concat( this );
    }

    ngOnInit(): void {
        // jQuery('#services>.student_service-list').hide();
        // Search sevice called by OnChanges when initializing.
        this._searchService.restApiUrl = this.api;
    }

    ngOnChanges(): void {
        this._searchService.restApiUrl = this.api;
        this.isLoading = ( this.isInit ) ? false : true;
        // TODO: observe this.query instead of creating a new subscription on every change.
        this._searchService.getStudentServices( this.query )
            .subscribe(
                studentServices => {
                    this.studentServices = studentServices;
                    this.resultsChanged.emit( { query: this.query, results: this.studentServices } );
                    this.isLoading = false;
                },
                error => this.errorMessage = <any>error
            );
        this.isInit = false;
    }

    hasResults(): boolean {
        return null !== this.studentServices;
    }

    clearResults(): void {
        this.query = "";
        this.studentServices = window.ucf_searchResults_initial;
        this.resultsChanged.emit( { query: this.query, results: this.studentServices } );
    }
}
