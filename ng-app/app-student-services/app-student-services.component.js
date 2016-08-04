System.register(["@angular/core", "rxjs/Rx", "./search", '../calendar/calendar.component', '../campaign/campaign.component'], function(exports_1, context_1) {
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
    var core_1, search_1, calendar_component_1, campaign_component_1;
    var AppStudentServicesComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (_1) {},
            function (search_1_1) {
                search_1 = search_1_1;
            },
            function (calendar_component_1_1) {
                calendar_component_1 = calendar_component_1_1;
            },
            function (campaign_component_1_1) {
                campaign_component_1 = campaign_component_1_1;
            }],
        execute: function() {
            AppStudentServicesComponent = (function () {
                // Can't use @Input() (or ng-content) with a root Angular2 element.
                // http://stackoverflow.com/a/33641842 and https://github.com/angular/angular/issues/1858#issuecomment-137696843
                // http://stackoverflow.com/a/32574733
                function AppStudentServicesComponent(elementRef, _searchService, _renderer) {
                    var _this = this;
                    this.elementRef = elementRef;
                    this._searchService = _searchService;
                    this._renderer = _renderer;
                    this.title = "Student Services";
                    this.initialResults = window.ucf_searchResults_initial;
                    this.form = "#";
                    this.search_lead = window.ucf_search_lead;
                    this.search_placeholder = window.ucf_search_placeholder;
                    this.campaign_primary = window.ucf_campaign_primary;
                    this.campaign_sidebar = window.ucf_campaign_sidebar;
                    this.filters = {};
                    this.noServicesVisible = function () { return 0 === jQuery('.service:visible').length; };
                    this.filterClear = function () { return jQuery.map(_this.filters, function (cat) { return cat.checked; }).every(function (x) { return 'false' == x; }); };
                    var native = this.elementRef.nativeElement;
                    this.api = native.getAttribute("[api]");
                    this.title = native.getAttribute("[title]");
                    this.query = native.getAttribute("[query]");
                    this._renderer.setElementProperty(this.elementRef.nativeElement, 'value', this.query);
                    window.ucf_comp_studentServices = (window.ucf_comp_studentServices || []).concat(this);
                }
                // Receive event from SearchFormComponent.search EventEmitter.
                AppStudentServicesComponent.prototype.onSearch = function (newSearch) {
                    this.query = newSearch;
                };
                // Receive event from onChange and onBlur.
                AppStudentServicesComponent.prototype.onSearchChanged = function (change) {
                    this.query = (change.target).value;
                };
                AppStudentServicesComponent.prototype.onResultsChanged = function (results) {
                    this.query = results.query;
                    // this.searchForm.frontsearch_query = results.query;
                };
                AppStudentServicesComponent.prototype.onFilterChanged = function (category) {
                    this.filters[category.name] = category;
                    this.searchResults.filters = this.filters;
                };
                AppStudentServicesComponent.prototype.ngOnInit = function () { };
                AppStudentServicesComponent.prototype.ngOnChanges = function () { };
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], AppStudentServicesComponent.prototype, "api", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], AppStudentServicesComponent.prototype, "title", void 0);
                __decorate([
                    core_1.Input("results"), 
                    __metadata('design:type', Array)
                ], AppStudentServicesComponent.prototype, "initialResults", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], AppStudentServicesComponent.prototype, "query", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], AppStudentServicesComponent.prototype, "form", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], AppStudentServicesComponent.prototype, "search_lead", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], AppStudentServicesComponent.prototype, "search_placeholder", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], AppStudentServicesComponent.prototype, "campaign_primary", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], AppStudentServicesComponent.prototype, "campaign_sidebar", void 0);
                __decorate([
                    core_1.ViewChild(search_1.SearchResultsComponent), 
                    __metadata('design:type', search_1.SearchResultsComponent)
                ], AppStudentServicesComponent.prototype, "searchResults", void 0);
                AppStudentServicesComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-app-student-services",
                        moduleId: __moduleName,
                        // template: `${window.ucfAppStudentServices}`, // http://stackoverflow.com/questions/32568808/angular2-root-component-with-ng-content
                        templateUrl: "./app-student-services.component.html",
                        directives: [search_1.SearchFormComponent, search_1.SearchResultsComponent, search_1.SearchFilterComponent, calendar_component_1.CalendarEventsComponent, campaign_component_1.CampaignComponent,],
                    }), 
                    __metadata('design:paramtypes', [core_1.ElementRef, search_1.SearchService, core_1.Renderer])
                ], AppStudentServicesComponent);
                return AppStudentServicesComponent;
            }());
            exports_1("AppStudentServicesComponent", AppStudentServicesComponent);
        }
    }
});
//# sourceMappingURL=app-student-services.component.js.map