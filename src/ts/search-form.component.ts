import { Component, ElementRef, OnInit, OnChanges, Output, Input, EventEmitter } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";
import { Observable } from "rxjs/Rx";
import "rxjs/add/operator/debounceTime";

// import { TYPEAHEAD_DIRECTIVES } from "ng2-bootstrap/ng2-bootstrap";
import { TYPEAHEAD_DIRECTIVES } from "ng2-bootstrap/components/typeahead";

import { UnescapeHtmlPipe } from "./unescapeHtml.filter";

@Component({
    selector: "ucf-search-form",
    moduleId: module.id,
    templateUrl: "./search-form.component.html",
    // styleUrls: ["../../scss/_search.scss"],
    directives: [ TYPEAHEAD_DIRECTIVES, ],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchFormComponent implements OnInit, OnChanges {
    @Input() debounce: number = 350;
    @Input() lead: string = "From orientation to graduation, the UCF experience creates opportunities that last a lifetime. <b>Let's get started</b>";
    @Input() placeholder: string = "What can we help you with today?";
    @Input() action: string = "#";
    searchSuggestions = window.ucf_searchSuggestions;

    frontsearch_query: string = "";
    @Output() search: EventEmitter<string> = new EventEmitter<string>();
    typeaheadLoading: boolean = false;
    typeaheadNoResults: boolean = false;

    constructor( public elementRef: ElementRef ) {
        window.ucf_comp_searchForm = (window.ucf_comp_searchForm || []).concat(this);
    }

    ngOnInit(): void {
        jQuery("article>section#search-frontpage").hide();
        // Debounce Tutorial: https://manuel-rauber.com/2015/12/31/debouncing-angular-2-input-component/
        const debouncedInputStream = Observable.fromEvent( this.elementRef.nativeElement, 'keyup' )
            .map( () => this.frontsearch_query )
            .debounceTime( this.debounce )
            .distinctUntilChanged();

        debouncedInputStream.subscribe(input => {
            // Don't unload results if user clears search input.
            if( "" !== input ) {
                this.frontsearch_query = input;
                this.search.emit( this.frontsearch_query );
            }
        });
    }

    ngOnChanges(): void {
        this.search.emit( this.frontsearch_query );
    }

    public typeaheadOnSelect( e: any ): void {
        this.frontsearch_query = e.item;
        this.search.emit( this.frontsearch_query );
    }

    public changeTypeaheadLoading( e: boolean ): void {
      this.typeaheadLoading = e;
    }

    public changeTypeaheadNoResults( e: boolean ): void {
      this.typeaheadNoResults = e;
    }
}
