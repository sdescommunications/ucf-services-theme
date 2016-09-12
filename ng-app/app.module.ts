import { NgModule, CUSTOM_ELEMENTS_SCHEMA }       from "@angular/core";
import { BrowserModule  } from "@angular/platform-browser";
import { FormsModule }   from "@angular/forms";
import { HttpModule } from "@angular/http";

// import "rxjs/Rx"; // Load all features (uncomment during development for intellisense).
import { TypeaheadModule } from "ng2-bootstrap/ng2-bootstrap";


import { AppStudentServicesComponent } from "./app-student-services/app-student-services.component";
import { SearchFormComponent, SearchResultsComponent, SearchFilterComponent, SearchService } from "./app-student-services/search";
import { CalendarEventsComponent } from "./calendar/calendar.component";
import { CalendarService } from "./calendar/calendar.service";
import { CampaignComponent } from "./campaign/campaign.component";
// TODO: remove pipe from templates - duplicates functionality from DomSanitizer.
import { UnescapeHtmlPipe } from "./pipes/unescapeHtml.pipe";


@NgModule({
    declarations: [
        AppStudentServicesComponent,
        SearchFormComponent, SearchResultsComponent, SearchFilterComponent,
        CalendarEventsComponent, CampaignComponent,
        UnescapeHtmlPipe
    ],
    imports:      [
        BrowserModule,
        FormsModule,
        HttpModule,
        TypeaheadModule,
    ],
    providers: [
        // Services
        SearchService,
        CalendarService,
    ],
    schemas: [CUSTOM_ELEMENTS_SCHEMA], // TODO: make "ucf-like-tweet-share" into a proper component.
    bootstrap:    [AppStudentServicesComponent],
})
export class AppModule {}
