import { Component, OnInit, OnChanges, Output, Input, EventEmitter } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";
import "rxjs/add/operator/debounceTime";

import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-form",
    moduleId: __moduleName,
    templateUrl: "./form.component.html",
    // styleUrls: ["../../scss/_search.scss"],
    // directives: [  ],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchFormComponent implements OnInit, OnChanges {
    @Input() debounce: number;
    @Input() lead: string = "From orientation to graduation, the UCF experience creates opportunities that last a lifetime. <b>Let's get started</b>";
    @Input() placeholder: string = "What can we help you with today?";
    @Input() action: string = "#";
    searchSuggestions = window.ucf_searchSuggestions;

    frontsearch_query: string = "";
    @Output() search: EventEmitter<string> = new EventEmitter<string>();

    ngOnInit(): void {
        jQuery("article>section#search-frontpage").hide();
        // TODO: observe searches, subscribe to debounced input.
    }

    ngOnChanges(): void {
        this.search.emit( this.frontsearch_query );
    }
}
