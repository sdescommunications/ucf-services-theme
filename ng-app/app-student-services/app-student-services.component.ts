import { Component, ElementRef, OnInit, OnChanges,
    Input, EventEmitter, Renderer, ViewChild } from "@angular/core";
import { HTTP_PROVIDERS } from "@angular/http";
import "rxjs/Rx";   // Load all features

// import { SearchFormComponent } from "./search/form";
// import { SearchResultsComponent } from "./search/results";
// import { SearchService } from "./search/service";
import { SearchFormComponent, SearchResultsComponent, SearchFilterComponent, SearchService } from "./search";
import { CalendarEventsComponent } from '../calendar/calendar.component';
import { CampaignComponent } from '../campaign/campaign.component';
import { IStudentService } from "./interfaces/studentservice";

@Component({
    selector: "ucf-app-student-services",
    moduleId: __moduleName,
    // template: `${window.ucfAppStudentServices}`, // http://stackoverflow.com/questions/32568808/angular2-root-component-with-ng-content
    templateUrl: "./app-student-services.component.html",
    directives: [ SearchFormComponent, SearchResultsComponent, SearchFilterComponent, CalendarEventsComponent, CampaignComponent, ],
})
export class AppStudentServicesComponent {
    @Input() api: string;
    @Input() title: string = "Student Services";
    @Input("results") initialResults: IStudentService[] = window.ucf_searchResults_initial;
    @Input() query: string;
    @Input() form: string = "#";
    @Input() campaign_primary = window.ucf_campaign_primary;
    @Input() campaign_sidebar = window.ucf_campaign_sidebar;
    filters: any = {};
    noServicesVisible = () => 0 === jQuery('.service:visible').length;
    filterClear = () => jQuery.map( this.filters, (cat) => cat.checked ).every( (x) => 'false' == x )
    @ViewChild(SearchResultsComponent) private searchResults: SearchResultsComponent;

    // Can't use @Input() (or ng-content) with a root Angular2 element.
    // http://stackoverflow.com/a/33641842 and https://github.com/angular/angular/issues/1858#issuecomment-137696843
    // http://stackoverflow.com/a/32574733
    constructor( public elementRef: ElementRef, protected _searchService: SearchService, 
            protected _renderer: Renderer ) {
        let native = this.elementRef.nativeElement;
        this.api = native.getAttribute("[api]");
        this.title = native.getAttribute("[title]");
        this.query = native.getAttribute("[query]");
        this._renderer.setElementProperty( this.elementRef.nativeElement, 'value', this.query );
        window.ucf_comp_studentServices = ( window.ucf_comp_studentServices || [] ).concat( this );
    }


    // Receive event from SearchFormComponent.search EventEmitter.
    onSearch( newSearch: string ): void {
        this.query = newSearch;
    }
 
    // Receive event from onChange and onBlur.
    onSearchChanged( change: Event ): void {
        this.query = (<HTMLInputElement>(change.target)).value;
     }

    onResultsChanged( results: any ): void {
         this.query = results.query;
         // this.searchForm.frontsearch_query = results.query;
    }

    onFilterChanged( category: any): void {
        this.filters[ category.name ] = category;
        this.searchResults.filters = this.filters;
    }

    ngOnInit(): void { }

    ngOnChanges(): void { }
}

