import { bootstrap } from "@angular/platform-browser-dynamic";
import { disableDeprecatedForms, provideForms } from "@angular/forms";
import { HTTP_PROVIDERS } from "@angular/http";
import "rxjs/Rx";   // Load all features

import { SearchService } from "./search.service";
import { SearchFormComponent } from "./search-form.component";
import { SearchResultsComponent } from "./search-results.component";

import { AppStudentServicesComponent } from "./app-student-services.component";

// bootstrap( SearchResultsComponent, [ HTTP_PROVIDERS, SearchService ] )
//  .catch(err => console.error(err) );

// bootstrap( SearchFormComponent, [ SearchService ] )
//  .catch(err => console.error(err) );

bootstrap( AppStudentServicesComponent , [
        disableDeprecatedForms(), provideForms(), HTTP_PROVIDERS, SearchService
    ] )
    .catch( err => console.error(err) );