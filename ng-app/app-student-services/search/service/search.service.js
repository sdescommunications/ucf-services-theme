System.register(["@angular/core", "@angular/http", "rxjs/Observable", "rxjs/add/operator/map", "rxjs/add/operator/do", "rxjs/add/operator/catch"], function(exports_1, context_1) {
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
    var core_1, http_1, Observable_1;
    var SearchService;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (Observable_1_1) {
                Observable_1 = Observable_1_1;
            },
            function (_1) {},
            function (_2) {},
            function (_3) {}],
        execute: function() {
            SearchService = (function () {
                function SearchService(_http) {
                    this._http = _http;
                    this.restApiUrl = "/wp-json/rest/v1/services/"; // Default, should override to include entire site_url/rest_url.
                    this.DEBUG = 0;
                    window.ucf_svc_searchService = (window.ucf_svc_searchService || []).concat(this);
                }
                /**
                 * Fetch students services from a datasource.
                 * Implemented with a REST API, e.g.: https://www.ucf.edu/services/wp-json/rest/v1/services/?search=${query}
                 * For API discoverability, see http://v2.wp-api.org/guide/discovery/ and https://www.ucf.edu/services/wp-json/rest/v1/
                 */
                SearchService.prototype.getStudentServices = function (query) {
                    var _this = this;
                    query = (query) ? "?search=" + query : "";
                    var request = this.restApiUrl + query;
                    return this._http.get(request)
                        .map(function (response) { return response.json(); })
                        .do(function (data) { _this.debugInfo(data, request); })
                        .catch(this.handleError);
                };
                ;
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
                SearchService = __decorate([
                    core_1.Injectable(), 
                    __metadata('design:paramtypes', [http_1.Http])
                ], SearchService);
                return SearchService;
            }());
            exports_1("SearchService", SearchService);
        }
    }
});
//# sourceMappingURL=search.service.js.map