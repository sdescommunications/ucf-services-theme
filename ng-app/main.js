System.register(["@angular/platform-browser-dynamic", "@angular/forms", "@angular/http", "rxjs/Rx", "./app-student-services/search/service/search.service", "./app-student-services/app-student-services.component"], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var platform_browser_dynamic_1, forms_1, http_1, search_service_1, app_student_services_component_1;
    return {
        setters:[
            function (platform_browser_dynamic_1_1) {
                platform_browser_dynamic_1 = platform_browser_dynamic_1_1;
            },
            function (forms_1_1) {
                forms_1 = forms_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (_1) {},
            function (search_service_1_1) {
                search_service_1 = search_service_1_1;
            },
            function (app_student_services_component_1_1) {
                app_student_services_component_1 = app_student_services_component_1_1;
            }],
        execute: function() {
            // bootstrap( SearchResultsComponent, [ HTTP_PROVIDERS, SearchService ] )
            //  .catch(err => console.error(err) );
            // bootstrap( SearchFormComponent, [ SearchService ] )
            //  .catch(err => console.error(err) );
            platform_browser_dynamic_1.bootstrap(app_student_services_component_1.AppStudentServicesComponent, [
                forms_1.disableDeprecatedForms(), forms_1.provideForms(), http_1.HTTP_PROVIDERS, search_service_1.SearchService
            ])
                .catch(function (err) { return console.error(err); });
        }
    }
});
//# sourceMappingURL=main.js.map