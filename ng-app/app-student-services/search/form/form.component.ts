import { Component, ElementRef, OnInit, OnChanges, Output, Input, EventEmitter } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";
import { Observable } from "rxjs/Observable";
import "rxjs/add/observable/fromEvent";
import "rxjs/add/operator/map";
import "rxjs/add/operator/debounceTime";
import "rxjs/add/operator/distinctUntilChanged";
// import "rxjs/Rx"; // Load all features (uncomment during development for intellisense).

// import { TypeaheadDirective } from "ng2-bootstrap";
import { TypeaheadDirective } from "ng2-bootstrap/ng2-bootstrap";
// import { TypeaheadDirective } from 'ng2-bootstrap/components/typeahead';
// import { TypeaheadDirective } from "ng2-bootstrap/components/typeahead";

import { UnescapeHtmlPipe } from "../../../pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-form",
    moduleId: __moduleName,
    templateUrl: "./form.component.html",
    // styleUrls: ["../../scss/_search.scss"],
    // directives: [ TypeaheadDirective, ],
    // pipes: [ UnescapeHtmlPipe ],
})
export class SearchFormComponent implements OnInit, OnChanges {
    @Input() debounce: number = 350;
    @Input() lead: string = "From orientation to graduation, the UCF experience creates opportunities that last a lifetime. <b>Let's get started</b>";
    @Input() placeholder: string = "What can we help you with today?";
    @Input() action: string = "#";
    hasSearched = false;
    searchSuggestions = window.ucf_searchSuggestions || {};
    typeaheadLoading: boolean = false;
    typeaheadNoResults: boolean = false;

    @Input() frontsearch_query: string;
    @Output() search: EventEmitter<string> = new EventEmitter<string>();

    constructor( public elementRef: ElementRef ) {
        window.ucf_comp_searchForm = (window.ucf_comp_searchForm || []).concat(this);
    }

    ngOnInit(): void {
        jQuery("article>section#search-frontpage").hide();
        // Debounce Tutorial: https://manuel-rauber.com/2015/12/31/debouncing-angular-2-input-component/
        const debouncedInputStream = Observable.fromEvent( this.elementRef.nativeElement, "keyup" )
            .map( () => this.frontsearch_query )
            .debounceTime( this.debounce )
            .distinctUntilChanged();

        debouncedInputStream.subscribe(input => {
            // Don't unload results if user clears search input.
            if ( "" !== input ) {
                this.frontsearch_query = input;
                ( this.hasSearched )
                    ? this.search.emit( this.frontsearch_query )
                    : this.hasSearched = true;
            }
        });
    }

    ngOnChanges(): void {
        ( this.hasSearched )
            ? this.search.emit( this.frontsearch_query )
            : this.hasSearched = true;
    }

    typeaheadOnSelect( e: any ): void {
        this.frontsearch_query = e.item;
        this.search.emit( this.frontsearch_query );
    }

    changeTypeaheadLoading( e: boolean ): void {
      this.typeaheadLoading = e;
    }

    changeTypeaheadNoResults( e: boolean ): void {
      this.typeaheadNoResults = e;
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
interface WindowUcfSearchForm extends Window { // Window from tsserver/lib.d.ts
    ucf_searchSuggestions: Object;
    ucf_comp_searchForm: any[];
}
declare var window: WindowUcfSearchForm;
