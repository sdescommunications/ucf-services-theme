import { Component, ElementRef, OnInit, OnChanges, Output, Input, EventEmitter, SimpleChanges } from "@angular/core";

import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-filter",
    moduleId: __moduleName,
    // templateUrl: "./filter.component.html",
    template: `<span class="filter-by">
                    <h2>Filter By</h2>
                    <div class="panel panel-default">
                        <ul class="list-group">
                            <li *ngFor="let category of categories"
                                class="cat-item cat-item-{{category.cat_ID}}"
                                (change)="onFilterChanged($event)">
                                <input class="filter-checkbox" type="checkbox" id="filter-services-{{category.cat_ID}}" 
                                        [(ngModel)]='category.checked'
                                        [attr.data-name]='category.name'
                                        [attr.data-cat_ID]='category.cat_ID'>
                                <label class="list-group-item filter-label"
                                        [attr.for]="'filter-services-' + category.cat_ID"
                                        [innerHTML]='category.name  | unescapeHtml'>
                                </label>
                            </li>
                        </ul>
                    </div>
                </span>`,
    // styleUrls: ["../../scss/_search.scss"],
    // directives: [ TYPEAHEAD_DIRECTIVES, ],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchFilterComponent {
    categories: any[] = window.ucf_service_categories;

    @Output() filterChanged = new EventEmitter<any>();

    constructor( public elementRef: ElementRef ) {
        window.ucf_comp_searchFilter = (window.ucf_comp_searchFilter || []).concat(this);
        for(let category of this.categories) {
            category["checked"] = false;
        }
    }

    ngOnChanges( changes: SimpleChanges ): any { }

    onFilterChanged( e: Event) {
        var category = e.target.dataset;
        category["checked"] = e.target.checked;
        this.filterChanged.emit( category );  
    }
}
