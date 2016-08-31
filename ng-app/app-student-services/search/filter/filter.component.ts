import { Component, ElementRef, OnInit, OnChanges, Output, Input, EventEmitter, SimpleChanges } from "@angular/core";

import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-filter",
    moduleId: __moduleName,
    templateUrl: "./filter.component.html",
    // styleUrls: ["../../scss/_search.scss"],
    // directives: [ TYPEAHEAD_DIRECTIVES, ],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchFilterComponent {
    categories: any[] = window.ucf_service_categories;

    @Output() filterChanged = new EventEmitter<any>();

    constructor( public elementRef: ElementRef ) {
        window.ucf_comp_searchFilter = (window.ucf_comp_searchFilter || []).concat(this);
        if( null != this.categories) {
            for(let category of this.categories) {
                category["checked"] = false;
            }
        }
    }

    ngOnChanges( changes: SimpleChanges ): any { }

    onFilterChanged( e: Event) {
        var category = e.target.dataset;
        category["checked"] = e.target.checked;
        this.filterChanged.emit( category );  
    }

    hasCategories(): boolean {
        return 
            null !== this.categories && 'undefined' != typeof this.categories
            && this.categories.length > 0;
    }
}
