System.register(["@angular/core", "rxjs/Observable", "rxjs/add/observable/fromEvent", "rxjs/add/operator/map", "rxjs/add/operator/debounceTime", "rxjs/add/operator/distinctUntilChanged"], function (exports_1, context_1) {
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
    var core_1, Observable_1, SearchFormComponent;
    return {
        setters: [
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (Observable_1_1) {
                Observable_1 = Observable_1_1;
            },
            function (_1) {
            },
            function (_2) {
            },
            function (_3) {
            },
            function (_4) {
            }
        ],
        execute: function () {
            SearchFormComponent = (function () {
                function SearchFormComponent(elementRef) {
                    this.elementRef = elementRef;
                    this.debounce = 350;
                    this.lead = "From orientation to graduation, the UCF experience creates opportunities that last a lifetime. <b>Let's get started</b>";
                    this.placeholder = "What can we help you with today?";
                    this.action = "#";
                    this.hasSearched = false;
                    this.searchSuggestions = window.ucf_searchSuggestions || {};
                    this.typeaheadLoading = false;
                    this.typeaheadNoResults = false;
                    this.search = new core_1.EventEmitter();
                    window.ucf_comp_searchForm = (window.ucf_comp_searchForm || []).concat(this);
                }
                SearchFormComponent.prototype.ngOnInit = function () {
                    var _this = this;
                    jQuery("article>section#search-frontpage").hide();
                    // Debounce Tutorial: https://manuel-rauber.com/2015/12/31/debouncing-angular-2-input-component/
                    var debouncedInputStream = Observable_1.Observable.fromEvent(this.elementRef.nativeElement, "keyup")
                        .map(function () { return _this.frontsearch_query; })
                        .debounceTime(this.debounce)
                        .distinctUntilChanged();
                    debouncedInputStream.subscribe(function (input) {
                        // Don't unload results if user clears search input.
                        if ("" !== input) {
                            _this.frontsearch_query = input;
                            (_this.hasSearched)
                                ? _this.search.emit(_this.frontsearch_query)
                                : _this.hasSearched = true;
                        }
                    });
                };
                SearchFormComponent.prototype.ngOnChanges = function () {
                    (this.hasSearched)
                        ? this.search.emit(this.frontsearch_query)
                        : this.hasSearched = true;
                };
                SearchFormComponent.prototype.typeaheadOnSelect = function (e) {
                    this.frontsearch_query = e.item;
                    this.search.emit(this.frontsearch_query);
                };
                SearchFormComponent.prototype.changeTypeaheadLoading = function (e) {
                    this.typeaheadLoading = e;
                };
                SearchFormComponent.prototype.changeTypeaheadNoResults = function (e) {
                    this.typeaheadNoResults = e;
                };
                return SearchFormComponent;
            }());
            __decorate([
                core_1.Input(),
                __metadata("design:type", Number)
            ], SearchFormComponent.prototype, "debounce", void 0);
            __decorate([
                core_1.Input(),
                __metadata("design:type", String)
            ], SearchFormComponent.prototype, "lead", void 0);
            __decorate([
                core_1.Input(),
                __metadata("design:type", String)
            ], SearchFormComponent.prototype, "placeholder", void 0);
            __decorate([
                core_1.Input(),
                __metadata("design:type", String)
            ], SearchFormComponent.prototype, "action", void 0);
            __decorate([
                core_1.Input(),
                __metadata("design:type", String)
            ], SearchFormComponent.prototype, "frontsearch_query", void 0);
            __decorate([
                core_1.Output(),
                __metadata("design:type", core_1.EventEmitter)
            ], SearchFormComponent.prototype, "search", void 0);
            SearchFormComponent = __decorate([
                core_1.Component({
                    selector: "ucf-search-form",
                    moduleId: __moduleName,
                    templateUrl: "./form.component.html",
                }),
                __metadata("design:paramtypes", [core_1.ElementRef])
            ], SearchFormComponent);
            exports_1("SearchFormComponent", SearchFormComponent);
        }
    };
});
//# sourceMappingURL=form.component.js.map