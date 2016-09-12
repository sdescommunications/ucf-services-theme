import { Injectable } from "@angular/core";
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/add/operator/catch";
// import "rxjs/Rx"; // Load all features (uncomment during development for intellisense).

import { ICalendarEvent } from './ICalendarEvent';

@Injectable()
export class CalendarService {

    constructor( protected _http: Http ) {
        window.ucf_svc_calendarService = ( window.ucf_svc_calendarService || [] ).concat( this );
    }

    /**
     * Fetch calendar events from a datasource.
     */
    getCalendarEvents(): Observable<ICalendarEvent> {
        return Observable.from( window.ucf_calendar_events );
    };
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
// Window from tsserver/lib.d.ts
interface Window_ucf_svc extends Window {
    ucf_svc_calendarService: CalendarService[];
    ucf_calendar_events: ICalendarEvent[];
}
declare var window: Window_ucf_svc;
