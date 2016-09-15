import { Injectable } from "@angular/core";
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import { Subject } from 'rxjs/Subject'
import "rxjs/add/operator/map";
import "rxjs/add/operator/do";
import "rxjs/add/operator/catch";
// import "rxjs/add/operator/flatmap";
import "rxjs/add/operator/take";
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
        let query =
            ( search ) 
                ? `?limit=${limit}&search=${search}&paged=${paged}`
                : `?limit=${limit}&paged=${paged}`;
        let request = this.restApiUrl + query;
        let observableStream =
            this._http.get( request )
                .map( (response: Response) => <IStudentServiceSummary[]>response.json() )
                .do(
                    ( data ) => { 
                        this.debugInfo( data, request );
                        // Save state if successful.
                        this._search = search;
                        this._paged = paged;
                        this._limit = limit;
                })
                .catch( this.handleError );
        return observableStream;
        // Cast and store Observable as Subject. Would this work better if not returning an array? I.e., Observable<IStudentServiceSummary>
        // this._resultsStream = <Subject<IStudentServiceSummary[]>>observableStream;
        // return this._resultsStream;
    };

    getNextPage() : Observable<IStudentServiceSummary[]> {
        let nextPage = this._paged + 1;
        let query =
            ( this._search ) 
                ? `?limit=${this._limit}&search=${this._search}&paged=${nextPage}`
                : `?limit=${this._limit}&paged=${nextPage}`;
        let request = this.restApiUrl + query;
        let nextPageResults = this._http.get( request )
            .map( (response: Response) => <IStudentServiceSummary[]>response.json() )
            .do(
                ( data ) => {
                    this.debugInfo( data, request );
                    this._paged++; // Save state if successful.
            })
            .catch( this.handleError )
            // .flatMap( 
            //     ( nextResult, idx ) => { 
            //         this._resultsStream.next( nextResult );
            //         return nextResult; 
            // });
        return nextPageResults;
    }

    // TODO: extract shared code between getStudentServices and getNextPage.
    // buildRequestUrl(limit, search, paged): Observable<string>
    // requestJson( requestUrl )

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
