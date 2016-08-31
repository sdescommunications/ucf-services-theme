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
                    var _this = this;
                    this._searchService = _searchService;
                    this.api = "";
                    this.filters = {};
                    this.filterClear = function () { return jQuery.map(_this.filters, function (cat) { return cat.checked; }).every(function (x) { return 'false' == x; }); };
                    this.studentServices = window.ucf_searchResults_initial;
                    this.errorMessage = "";
                    this.isInit = true;
                    this.isLoading = false;
                    this.resultsChanged = new core_1.EventEmitter();
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
                    if (this.query === this._previousQuery && !this.isInit) {
                        return;
                    } // Prevent loop between events this.resultsChanged() <-> SearchFormComponent.search()
                    this.isLoading = (this.isInit) ? false : true; // Don't show loading text on initial load.
                    // TODO: observe this.query instead of creating a new subscription on every change.
                    this._searchService.getStudentServices(this.query)
                        .subscribe(function (studentServices) {
                        _this._previousQuery = _this.query;
                        _this.studentServices = studentServices;
                        _this.resultsChanged.emit({ query: _this.query, results: _this.studentServices });
                        _this.isLoading = false;
                    }, function (error) { return _this.errorMessage = error; });
                    this.isInit = false;
                };
                SearchResultsComponent.prototype.hasResults = function () {
                    return null !== this.studentServices;
                };
                SearchResultsComponent.prototype.clearResults = function () {
                    this.query = "";
                    this.studentServices = window.ucf_searchResults_initial;
                    this.resultsChanged.emit({ query: this.query, results: this.studentServices });
                };
                SearchResultsComponent.prototype.shouldFilter = function (categoryName) {
                    if ('undefined' == typeof categoryName) {
                        return false;
                    }
                    return this.filterClear() ||
                        (this.filters[categoryName]
                            && 'true' == this.filters[categoryName].checked);
                };
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], SearchResultsComponent.prototype, "query", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], SearchResultsComponent.prototype, "api", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], SearchResultsComponent.prototype, "filters", void 0);
                __decorate([
                    core_1.Output(), 
                    __metadata('design:type', core_1.EventEmitter)
                ], SearchResultsComponent.prototype, "resultsChanged", void 0);
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