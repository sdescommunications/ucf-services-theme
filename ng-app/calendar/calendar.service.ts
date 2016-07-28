import { Injectable } from "@angular/core";
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/add/operator/do";
import "rxjs/add/operator/catch";

@Injectable()
export class CalendarService {

    constructor( protected _http: Http ) {
        window.ucf_svc_calendarService = ( window.ucf_svc_calendarService || [] ).concat( this );
    }

    /**
     * Fetch calendar events from a datasource.
     */
    getCalendarEvents(): Observable<any[]> {
        return Observable.from( window.ucf_calendar_events );
    };
}
