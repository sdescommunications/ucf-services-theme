System.register(["@angular/core", "@angular/platform-browser", "@angular/forms", "@angular/http", "ng2-bootstrap/ng2-bootstrap", "./app-student-services/app-student-services.component", "./app-student-services/search", "./calendar/calendar.component", "./calendar/calendar.service", "./campaign/campaign.component", "./pipes/unescapeHtml.pipe"], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, platform_browser_1, forms_1, http_1, ng2_bootstrap_1, app_student_services_component_1, search_1, calendar_component_1, calendar_service_1, campaign_component_1, unescapeHtml_pipe_1;
    var AppModule;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (platform_browser_1_1) {
                platform_browser_1 = platform_browser_1_1;
            },
            function (forms_1_1) {
                forms_1 = forms_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (ng2_bootstrap_1_1) {
                ng2_bootstrap_1 = ng2_bootstrap_1_1;
            },
            function (app_student_services_component_1_1) {
                app_student_services_component_1 = app_student_services_component_1_1;
            },
            function (search_1_1) {
                search_1 = search_1_1;
            },
            function (calendar_component_1_1) {
                calendar_component_1 = calendar_component_1_1;
            },
            function (calendar_service_1_1) {
                calendar_service_1 = calendar_service_1_1;
            },
            function (campaign_component_1_1) {
                campaign_component_1 = campaign_component_1_1;
            },
            function (unescapeHtml_pipe_1_1) {
                unescapeHtml_pipe_1 = unescapeHtml_pipe_1_1;
            }],
        execute: function() {
            AppModule = (function () {
                function AppModule() {
                }
                AppModule = __decorate([
                    core_1.NgModule({
                        declarations: [
                            app_student_services_component_1.AppStudentServicesComponent,
                            search_1.SearchFormComponent, search_1.SearchResultsComponent, search_1.SearchFilterComponent,
                            calendar_component_1.CalendarEventsComponent, campaign_component_1.CampaignComponent,
                            unescapeHtml_pipe_1.UnescapeHtmlPipe
                        ],
                        imports: [
                            platform_browser_1.BrowserModule,
                            forms_1.FormsModule,
                            http_1.HttpModule,
                            ng2_bootstrap_1.TypeaheadModule,
                        ],
                        providers: [
                            // Services
                            search_1.SearchService,
                            calendar_service_1.CalendarService,
                        ],
                        schemas: [core_1.CUSTOM_ELEMENTS_SCHEMA],
                        bootstrap: [app_student_services_component_1.AppStudentServicesComponent],
                    }), 
                    __metadata('design:paramtypes', [])
                ], AppModule);
                return AppModule;
            }());
            exports_1("AppModule", AppModule);
        }
    }
});
//# sourceMappingURL=app.module.js.map