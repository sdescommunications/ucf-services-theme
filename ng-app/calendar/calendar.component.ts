import { Component, OnInit, OnChanges, Input } from "@angular/core";
import moment from "moment";

import { CalendarService } from "./calendar.service";
import { ICalendarEvent } from "./ICalendarEvent";

@Component({
    selector: "ucf-calendar-events",
    moduleId: __moduleName,
    // templateUrl: "./calendar-events.component.html",
    template:
        `<div class="calendar-events">
          <div class="collapsed" type="button"
             data-toggle="collapse" data-target="#calendar-expand"
             aria-expanded="true" aria-controls="collapseExample">
            <span class="calendar-events-title">
                <span class="fa fa-calendar-o calendar-icon"></span>
                {{ title }}
                <span class="fa fa-chevron-down calendar-chevron"></span>
            </span>
          </div>
            <div class="collapse" id="calendar-expand">
                <span *ngIf='! hasEvents()'>No events found.</span>

                <div class="event" *ngFor='let event of events'>
                    <div class="title" *ngIf="! event.url">
                        {{ event.summary }}
                    </div>
                    <div class="title" *ngIf="event.url">
                        <a href="{{ event.url }}" target="_blank">
                            {{ event.summary }}
                        </a>
                    </div>
                    <div class="date">{{ month_day(event) }}</div>
                </div>

                <div *ngIf='moreEventsLink'>
                    <a class="all-link external" href="{{ moreEventsLink }}" target="_blank">{{ moreEventsText }}</a>
                </div>
            </div>
        </div>`,
    // styleUrls: ["../../scss/_calendar_events.scss"],
    // directives: [  ],
    // pipes: [  ],
})
export class CalendarEventsComponent {
    @Input() title: string = "Academic Calendar";
    @Input() events: ICalendarEvent[] = window.ucf_calendar_events; // = [
    //  { summary: "An Event", url: "#", dtstart: "2016-07-01 00:00:00Z" },
    //  { summary: "Another Event", url: "#", dtstart: "2017-01-01 00:00:00Z" },
    // ];
    @Input() moreEventsLink: string = "#";
    @Input() moreEventsText: string = "More Events ›";
    errorMessage: any = "";

    constructor( protected _calendarService: CalendarService ) {
        window.ucf_comp_calendar = ( window.ucf_comp_calendar || [] ).concat( this );
    }

    ngOnInit() {
        this._calendarService.getCalendarEvents()
            .subscribe(
                event => { this.events.concat( event ); },
                error => { this.errorMessage = <any>error; }
            );
    }

    hasEvents(): boolean {
        return "undefined" !== typeof this.events && this.events && this.events.length > 0;
    }

    month_day( event: any ) {
        return moment( event.dtstart ).format( "MMM DD" );
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
// Window from tsserver/lib.d.ts
interface WindowUcfComp extends Window {
    ucf_comp_calendar: CalendarEventsComponent[];
    ucf_calendar_events: ICalendarEvent[];
}
declare var window: WindowUcfComp;
