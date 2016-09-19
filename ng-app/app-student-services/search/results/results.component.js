System.register(["@angular/core", "../service"], function(exports_1, context_1) {
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
    var core_1, service_1;
    var SearchResultsComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (service_1_1) {
                service_1 = service_1_1;
            }],
        execute: function() {
            SearchResultsComponent = (function () {
                function SearchResultsComponent(_searchService, _detector) {
                    var _this = this;
                    this._searchService = _searchService;
                    this._detector = _detector;
                    this.api = "";
                    this.filters = {};
                    this.filterClear = function () { return jQuery.map(_this.filters, function (cat) { return cat.checked; }).every(function (x) { return "false" === x; }); };
                    this.studentServices = window.ucf_searchResults_initial;
                    this.limit = window.ucf_searchResults_limit;
                    this.errorMessage = "";
                    this.isInit = true;
                    this.isLoading = false;
                    this.isLoadingMore = false;
                    this.canLoadMore = true;
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
                    this._searchService.getStudentServices(this.query, this.limit)
                        .subscribe(function (studentServices) {
                        _this._previousQuery = _this.query;
                        _this.studentServices = studentServices;
                        _this.resultsChanged.emit({ query: _this.query, results: _this.studentServices });
                        _this.isLoading = false;
                        _this.canLoadMore = true;
                    }, function (error) { return _this.errorMessage = error; });
                    this.isInit = false;
                };
                SearchResultsComponent.prototype.showNextPage = function (click) {
                    var _this = this;
                    click.preventDefault();
                    this.isLoadingMore = true; // Track state instead of figuring out how to debounceWithSelector.
                    this._searchService.getNextPage()
                        .subscribe(function (nextPageResults) {
                        _this.isLoadingMore = false;
                        if (null === nextPageResults) {
                            _this.canLoadMore = false;
                            return;
                        }
                        _this.studentServices = _this.studentServices.concat(nextPageResults);
                        // Force Angular to detect changes.
                        _this._detector.detectChanges();
                        _this.resultsChanged.emit({ query: _this.query, results: _this.studentServices });
                    }, function (error) { return _this.errorMessage = error; });
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
                    if ("undefined" === typeof categoryName) {
                        return false;
                    }
                    return this.filterClear() ||
                        (this.filters[categoryName]
                            && "true" === this.filters[categoryName].checked);
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
                    core_1.Input("results"), 
                    __metadata('design:type', Array)
                ], SearchResultsComponent.prototype, "studentServices", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Number)
                ], SearchResultsComponent.prototype, "limit", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Object)
                ], SearchResultsComponent.prototype, "showResultsHeading", void 0);
                __decorate([
                    core_1.Output(), 
                    __metadata('design:type', core_1.EventEmitter)
                ], SearchResultsComponent.prototype, "resultsChanged", void 0);
                SearchResultsComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-search-results",
                        moduleId: __moduleName,
                        templateUrl: "./results.component.html",
                    }), 
                    __metadata('design:paramtypes', [service_1.SearchService, core_1.ChangeDetectorRef])
                ], SearchResultsComponent);
                return SearchResultsComponent;
            }());
            exports_1("SearchResultsComponent", SearchResultsComponent);
        }
    }
});
//# sourceMappingURL=results.component.js.map