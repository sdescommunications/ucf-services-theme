import { Component, ElementRef, OnInit, OnChanges,
    Input, EventEmitter } from "@angular/core";
import { HTTP_PROVIDERS } from "@angular/http";
import "rxjs/Rx";   // Load all features

// import { SearchFormComponent } from "./search/form";
// import { SearchResultsComponent } from "./search/results";
// import { SearchService } from "./search/service";
import { SearchFormComponent, SearchResultsComponent, SearchService } from "./search";
import { IStudentService } from "./interfaces/studentservice";

@Component({
    selector: "ucf-app-student-services",
    moduleId: __moduleName,
    // template: `${window.ucfAppStudentServices}`, // http://stackoverflow.com/questions/32568808/angular2-root-component-with-ng-content
    templateUrl: "./app-student-services.component.html",
    directives: [ SearchFormComponent, SearchResultsComponent ],
})
export class AppStudentServicesComponent {
    @Input() api: string;
    @Input() title: string = "Student Services";
    @Input("results") initialResults: IStudentService[] = window.ucf_searchResults_initial;
    @Input() query: string = "";
    @Input() form: string = "#";

    // Can't use @Input() (or ng-content) with a root Angular2 element.
    // http://stackoverflow.com/a/33641842 and https://github.com/angular/angular/issues/1858#issuecomment-137696843
    // http://stackoverflow.com/a/32574733
    constructor( public elementRef: ElementRef, protected _searchService: SearchService ) {
        let native = this.elementRef.nativeElement;
        this.api = native.getAttribute("[api]");
        this.title = native.getAttribute("[title]");
        this.query = native.getAttribute("[query]");
    }


    onSearchChanged( newSearch: Event ): void {
        this.query = newSearch.target.value;
    }

    ngOnInit(): void { }

    ngOnChanges(): void { }
}

