System.register(["@angular/core", "@angular/http", "rxjs/Observable", "rxjs/add/operator/map", "rxjs/add/operator/do", "rxjs/add/operator/catch"], function (exports_1, context_1) {
    "use strict";
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var __moduleName = context_1 && context_1.id;
    var core_1, http_1, Observable_1, LIMIT_DEFAULT, PAGED_DEFAULT, SearchService;
    return {
        setters: [
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (Observable_1_1) {
                Observable_1 = Observable_1_1;
            },
            function (_1) {
            },
            function (_2) {
            },
            function (_3) {
            }
        ],
        execute: function () {
            LIMIT_DEFAULT = 7;
            PAGED_DEFAULT = 1;
            SearchService = (function () {
                function SearchService(_http) {
                    this._http = _http;
                    this.restApiUrl = "/wp-json/rest/v1/services/summary"; // Default, should override to include entire site_url/rest_url.
                    this.DEBUG = 0;
                    this._search = "";
                    this._limit = LIMIT_DEFAULT;
                    this._paged = PAGED_DEFAULT;
                    window.ucf_svc_searchService = (window.ucf_svc_searchService || []).concat(this);
                }
                /**
                 * Fetch students services from a datasource.
                 * Implemented with a REST API, e.g.: https://www.ucf.edu/services/wp-json/rest/v1/services/?search=${query}
                 * For API discoverability, see http://v2.wp-api.org/guide/discovery/ and https://www.ucf.edu/services/wp-json/rest/v1/
                 */
                SearchService.prototype.getStudentServices = function (search, limit, paged) {
                    var _this = this;
                    if (limit === void 0) { limit = LIMIT_DEFAULT; }
                    if (paged === void 0) { paged = PAGED_DEFAULT; }
                    var requestUrl = this.buildRequestUrl(limit, search, paged); // (number, string, number) -> Observable<string>
                    var resultsStream = this.requestJsonFrom(requestUrl) // string -> Observable<IStudentServiceSummary[]>
                        .do(function (_) {
                        // Save state if successful.
                        _this._search = search;
                        _this._paged = paged;
                        _this._limit = limit;
                    });
                    return resultsStream;
                };
                ;
                /**
                 * Fetch the next page of results for the current search term.
                 */
                SearchService.prototype.getNextPage = function () {
                    var _this = this;
                    var nextPage = this._paged + 1;
                    if (this.DEBUG) {
                        console.debug("Moving to page: " + nextPage);
                    }
                    var resultsStream = this.getPage(nextPage)
                        .do(function (_) {
                        // Save state if successful.
                        _this._paged = nextPage;
                    });
                    return resultsStream;
                };
                /**
                 * Peek at the page after the next page, but do not update the current page.
                 */
                SearchService.prototype.peekPageAfterNext = function () {
                    var pageAfterNext = this._paged + 2;
                    if (this.DEBUG) {
                        console.debug("Peeking at page: " + pageAfterNext);
                    }
                    return this.getPage(pageAfterNext);
                };
                /**
                 * Retrieve a specific page number, reusing any previously set limit and search string.
                 */
                SearchService.prototype.getPage = function (paged) {
                    if (paged === void 0) { paged = 1; }
                    var requestUrl = this.buildRequestUrl(this._limit, this._search, paged); // (number, string, number) -> Observable<string>
                    var resultsStream = this.requestJsonFrom(requestUrl); // string -> Observable<IStudentServiceSummary[]>;
                    return resultsStream;
                };
                /**
                 * Build a the url to fetch using values for the query parameters.
                 * In the long term (when the API is no longer experimental), this should probably be replaced
                 * with a RequestOptionsArgs object that is passed to _http.get.
                 * @see https://angular.io/docs/ts/latest/api/http/index/RequestOptionsArgs-interface.html
                 */
                SearchService.prototype.buildRequestUrl = function (limit, search, paged) {
                    if (limit === void 0) { limit = LIMIT_DEFAULT; }
                    if (search === void 0) { search = ""; }
                    if (paged === void 0) { paged = PAGED_DEFAULT; }
                    var query = (search)
                        ? "?limit=" + limit + "&search=" + search + "&paged=" + paged
                        : "?limit=" + limit + "&paged=" + paged;
                    var request = this.restApiUrl + query;
                    return request;
                };
                /** Get JSON from a URL, log with debugInfo, and catch errors. */
                SearchService.prototype.requestJsonFrom = function (requestUrl) {
                    var _this = this;
                    return this._http.get(requestUrl)
                        .map(function (response) { return response.json(); })
                        .do(function (data) {
                        _this.debugInfo(data, requestUrl);
                    })
                        .catch(this.handleError);
                };
                SearchService.prototype.handleError = function (error) {
                    if (this.DEBUG) {
                        console.error(error);
                    }
                    return Observable_1.Observable.throw(error.json().error || "Server error");
                };
                SearchService.prototype.debugInfo = function (data, request) {
                    switch (this.DEBUG) {
                        case 1:
                            console.debug("GET: " + request);
                            break;
                        case 2:
                            console.debug("GET: " + request + "\n" + JSON.stringify(data));
                            break;
                        case 0:
                        default:
                            break;
                    }
                };
                return SearchService;
            }());
            SearchService = __decorate([
                core_1.Injectable(),
                __metadata("design:paramtypes", [http_1.Http])
            ], SearchService);
            exports_1("SearchService", SearchService);
        }
    };
});
//# sourceMappingURL=search.service.js.map