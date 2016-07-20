import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";

import { SearchService } from "app-student-services/search";
import { IStudentService } from "app-student-services/interfaces";
import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-search-results",
    moduleId: __moduleName,
    templateUrl: "./results.component.html",
    // templateUrl: "./results._template.php",
    // styleUrls: ["../../scss/_service.scss"],
    // directives: [],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchResultsComponent {
    @Input() query: string = "";
    @Input() api: string = "";
    studentServices: IStudentService[] = window.ucf_searchResults_initial;
    errorMessage: string = "";
    constructor( protected _searchService: SearchService ) {}

    ngOnInit(): void {
        // jQuery('#services>.student_service-list').hide();
        // Search sevice called by OnChanges when initializing.
        this._searchService.restApiUrl = this.api;
    }

    ngOnChanges(): void {
        this._searchService.restApiUrl = this.api;
        this._searchService.getStudentServices( this.query )
            .subscribe(
                studentServices => this.studentServices = studentServices,
                error => this.errorMessage = <any>error
            );
    }
}
