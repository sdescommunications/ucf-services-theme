System.register(["@angular/core", "app-student-services/search", "pipes/unescapeHtml.pipe"], function(exports_1, context_1) {
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
    var core_1, search_1, unescapeHtml_pipe_1;
    var SearchResultsComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (search_1_1) {
                search_1 = search_1_1;
            },
            function (unescapeHtml_pipe_1_1) {
                unescapeHtml_pipe_1 = unescapeHtml_pipe_1_1;
            }],
        execute: function() {
            SearchResultsComponent = (function () {
                function SearchResultsComponent(_searchService) {
                    this._searchService = _searchService;
                    this.query = "";
                    this.api = "";
                    this.studentServices = window.ucf_searchResults_initial;
                    this.errorMessage = "";
                    this.isInit = true;
                    this.isLoading = false;
                    window.ucf_comp_searchResults = (window.ucf_comp_searchResults || []).concat(this);
                }
                SearchResultsComponent.prototype.ngOnInit = function () {
                    // jQuery('#services>.student_service-list').hide();
                    // Search sevice called by OnChanges when initializing.
                    this._searchService.restApiUrl = this.api;
                };
                SearchResultsComponent.prototype.ngOnChanges = function () {
                    var _this = this;
                    this._searchService.restApiUrl = this.api;
                    this.isLoading = (this.isInit) ? false : true;
                    // TODO: observe this.query instead of creating a new subscription on every change.
                    this._searchService.getStudentServices(this.query)
                        .subscribe(function (studentServices) {
                        _this.studentServices = studentServices;
                        _this.isLoading = false;
                    }, function (error) { return _this.errorMessage = error; });
                    this.isInit = false;
                };
                SearchResultsComponent.prototype.hasResults = function () {
                    return null !== this.studentServices;
                };
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], SearchResultsComponent.prototype, "query", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], SearchResultsComponent.prototype, "api", void 0);
                SearchResultsComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-search-results",
                        moduleId: __moduleName,
                        templateUrl: "./results.component.html",
                        // templateUrl: "./results._template.php",
                        // styleUrls: ["../../scss/_service.scss"],
                        // directives: [],
                        pipes: [unescapeHtml_pipe_1.UnescapeHtmlPipe],
                    }), 
                    __metadata('design:paramtypes', [(typeof (_a = typeof search_1.SearchService !== 'undefined' && search_1.SearchService) === 'function' && _a) || Object])
                ], SearchResultsComponent);
                return SearchResultsComponent;
                var _a;
            }());
            exports_1("SearchResultsComponent", SearchResultsComponent);
        }
    }
});
//# sourceMappingURL=results.component.js.map