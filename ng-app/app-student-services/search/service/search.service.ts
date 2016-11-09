import { Injectable } from "@angular/core";
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import { Subject } from "rxjs/Subject";
import "rxjs/add/operator/map";
import "rxjs/add/operator/do";
import "rxjs/add/operator/catch";
// import "rxjs/Rx"; // Load all features (uncomment during development for intellisense).

import { IStudentServiceSummary } from "../../../app-student-services/interfaces";

const LIMIT_DEFAULT = 7;
const PAGED_DEFAULT = 1;

@Injectable()
export class SearchService {
    public restApiUrl = "/wp-json/rest/v1/services/summary";  // Default, should override to include entire site_url/rest_url.
    public DEBUG = 0;
    private _search = "";
    private _resultsStream: Subject<IStudentServiceSummary[]>;
    private _limit = LIMIT_DEFAULT;
    private _paged = PAGED_DEFAULT;

    constructor( protected _http: Http ) {
        window.ucf_svc_searchService = ( window.ucf_svc_searchService || [] ).concat( this );
    }

    /**
     * Fetch students services from a datasource.
     * Implemented with a REST API, e.g.: https://www.ucf.edu/services/wp-json/rest/v1/services/?search=${query}
     * For API discoverability, see http://v2.wp-api.org/guide/discovery/ and https://www.ucf.edu/services/wp-json/rest/v1/
     */
    getStudentServices( search: string, limit = LIMIT_DEFAULT, paged = PAGED_DEFAULT ): Observable<IStudentServiceSummary[]> {
        let requestUrl = this.buildRequestUrl(limit, search, paged);  // (number, string, number) -> Observable<string>
        let resultsStream =
                this.requestJsonFrom( requestUrl )    // string -> Observable<IStudentServiceSummary[]>
                .do( (_) => {
                        // Save state if successful.
                        this._search = search;
                        this._paged = paged;
                        this._limit = limit;
                });
        return resultsStream;
    };

    /**
     * Fetch the next page of results for the current search term.
     */
    getNextPage(): Observable<IStudentServiceSummary[]> {
        let nextPage = this._paged + 1;
        if ( this.DEBUG ) { console.debug( `Moving to page: ${nextPage}` ); }
        let resultsStream = 
                this.getPage(nextPage)
                .do( (_) => {
                    // Save state if successful.
                    this._paged = nextPage;
                });
        return resultsStream;
    }

    /**
     * Peek at the page after the next page, but do not update the current page.
     */
    peekPageAfterNext(): Observable<IStudentServiceSummary[]> {
        let pageAfterNext = this._paged + 2;
        if ( this.DEBUG ) { console.debug( `Peeking at page: ${pageAfterNext}` ); }
        return this.getPage( pageAfterNext );    
    }

    /**
     * Retrieve a specific page number, reusing any previously set limit and search string.
     */
    getPage( paged = 1 ): Observable<IStudentServiceSummary[]> {
        let requestUrl = this.buildRequestUrl(this._limit, this._search, paged);  // (number, string, number) -> Observable<string>
        let resultsStream = this.requestJsonFrom( requestUrl );    // string -> Observable<IStudentServiceSummary[]>;
        return resultsStream;       
    }

    /**
     * Build a the url to fetch using values for the query parameters.
     * In the long term (when the API is no longer experimental), this should probably be replaced
     * with a RequestOptionsArgs object that is passed to _http.get.
     * @see https://angular.io/docs/ts/latest/api/http/index/RequestOptionsArgs-interface.html
     */
    buildRequestUrl(limit = LIMIT_DEFAULT, search = "", paged = PAGED_DEFAULT): string {
        let query =
            ( search )
                ? `?limit=${limit}&search=${search}&paged=${paged}`
                : `?limit=${limit}&paged=${paged}`;
        let request = this.restApiUrl + query;
        return request;
    }

    /** Get JSON from a URL, log with debugInfo, and catch errors. */
    protected requestJsonFrom( requestUrl: string ): Observable<IStudentServiceSummary[]> {
        return this._http.get( requestUrl )
            .map( (response: Response) => <IStudentServiceSummary[]>response.json() )
            .do( (data) => {
                this.debugInfo( data, requestUrl );
            })
            .catch( this.handleError );
    }

    private handleError( error: Response ) {
        if ( this.DEBUG ) { console.error( error ); }
        return Observable.throw( error.json().error || "Server error" );
    }

    private debugInfo( data: any, request: string ): void {
        switch ( this.DEBUG ) {
            case 1:
                console.debug( `GET: ${request}` );
                break;
            case 2:
                console.debug( `GET: ${request}\n${ JSON.stringify( data ) }` );
                break;
            case 0:
            default:
                break;
        }
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;  // Shim for SystemJS/ES6 module identification.
// Window from tsserver/lib.d.ts
interface WindowUcfSvc extends Window {
    ucf_svc_searchService: SearchService[];
}
declare var window: WindowUcfSvc;
