import { Injectable } from "@angular/core";
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/add/operator/do";
import "rxjs/add/operator/catch";

import { IStudentService } from "app-student-services/interfaces";

@Injectable()
export class SearchService {
    public restApiUrl = "/wp-json/rest/v1/services/";  // Default, should override to include entire site_url/rest_url.
    public DEBUG = 0;

    constructor( protected _http: Http ) {
        window.ucf_svc_searchService = ( window.ucf_svc_searchService || [] ).concat( this );
    }

    /**
     * Fetch students services from a datasource.
     * Implemented with a REST API, e.g.: https://www.ucf.edu/services/wp-json/rest/v1/services/?search=${query}
     * For API discoverability, see http://v2.wp-api.org/guide/discovery/ and https://www.ucf.edu/services/wp-json/rest/v1/
     */
    getStudentServices( query: string ): Observable<IStudentService[]> {
        query = ( query ) ? `?search=${query}` : "";
        let request = this.restApiUrl + query;
        return this._http.get( request )
                .map( (response: Response) => <IStudentService[]>response.json() )
                .do(
                    ( data ) => { this.debugInfo( data, request ); }
                )
                .catch( this.handleError );
    };

    private handleError( error: Response ) {
        if ( this.DEBUG ) { console.error( error ); }
        return Observable.throw( error.json().error || "Server error" );
    }

    private debugInfo( data: JSON, request: string ): void {
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
