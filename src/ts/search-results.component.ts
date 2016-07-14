import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { SafeHtml } from "@angular/platform-browser";

import { SearchService } from "./search.service";
import { IStudentService } from "./studentservice.interface";
import { UnescapeHtmlPipe } from "./unescapeHtml.filter";

@Component({
    selector: "ucf-search-results",
    moduleId: module.id,
    templateUrl: "./search-results.component.html",
    // templateUrl: "./search-results._template.php",
    // styleUrls: ["../../scss/_service.scss"],
    // directives: [],
    pipes: [ UnescapeHtmlPipe ],
})
export class SearchResultsComponent {
    @Input() query: string = "";
    @Input() api: string = "";
    studentServices: IStudentService[] = null;
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
