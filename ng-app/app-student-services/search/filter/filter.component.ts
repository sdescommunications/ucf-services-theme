import { Component, ElementRef, OnInit, OnChanges, Output, Input, EventEmitter, SimpleChanges } from "@angular/core";

import { IWpCategory } from "../../interfaces/index";
import { UnescapeHtmlPipe } from "../../../pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-filter",
    moduleId: __moduleName,
    templateUrl: "./filter.component.html",
    // styleUrls: ["../../scss/_search.scss"],
    // directives: [ TYPEAHEAD_DIRECTIVES, ],
    // pipes: [ UnescapeHtmlPipe ],
})
export class SearchFilterComponent {
    categories: IWpCategory[] = window.ucf_service_categories;

    @Output() filterChanged = new EventEmitter<any>();

    constructor( public elementRef: ElementRef ) {
        window.ucf_comp_searchFilter = (window.ucf_comp_searchFilter || []).concat(this);
        if ( null != this.categories) {
            for (let category of this.categories) {
                category["checked"] = false;
            }
        }
    }

    ngOnChanges( changes: SimpleChanges ): any { }

    onFilterChanged( e: Event) {
        let target = <HTMLInputElement>e.target;
        let category: any = target.dataset;
        category["checked"] = target.checked;
        this.filterChanged.emit( category );
    }

    hasCategories(): boolean {
        return null !== this.categories
            && "undefined" !== typeof this.categories
            && this.categories.length > 0;
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;  // Shim for SystemJS/ES6 module identification.
// Window from tsserver/lib.d.ts
interface WindowUcfComp extends Window {
    ucf_comp_searchFilter: SearchFilterComponent[];
    ucf_service_categories: IWpCategory[];
}
declare var window: WindowUcfComp;
