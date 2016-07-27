System.register(["@angular/core", "pipes/unescapeHtml.pipe"], function(exports_1, context_1) {
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
    var core_1, unescapeHtml_pipe_1;
    var SearchFilterComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (unescapeHtml_pipe_1_1) {
                unescapeHtml_pipe_1 = unescapeHtml_pipe_1_1;
            }],
        execute: function() {
            SearchFilterComponent = (function () {
                function SearchFilterComponent(elementRef) {
                    this.elementRef = elementRef;
                    this.categories = window.ucf_service_categories;
                    this.filterChanged = new core_1.EventEmitter();
                    window.ucf_comp_searchFilter = (window.ucf_comp_searchFilter || []).concat(this);
                    if (null != this.categories) {
                        for (var _i = 0, _a = this.categories; _i < _a.length; _i++) {
                            var category = _a[_i];
                            category["checked"] = false;
                        }
                    }
                }
                SearchFilterComponent.prototype.ngOnChanges = function (changes) { };
                SearchFilterComponent.prototype.onFilterChanged = function (e) {
                    var category = e.target.dataset;
                    category["checked"] = e.target.checked;
                    this.filterChanged.emit(category);
                };
                SearchFilterComponent.prototype.hasCategories = function () {
                    return;
                    null !== this.categories && 'undefined' != typeof this.categories
                        && this.categories.length > 0;
                };
                __decorate([
                    core_1.Output(), 
                    __metadata('design:type', Object)
                ], SearchFilterComponent.prototype, "filterChanged", void 0);
                SearchFilterComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-search-filter",
                        moduleId: __moduleName,
                        templateUrl: "./filter.component.html",
                        // styleUrls: ["../../scss/_search.scss"],
                        // directives: [ TYPEAHEAD_DIRECTIVES, ],
                        pipes: [unescapeHtml_pipe_1.UnescapeHtmlPipe],
                    }), 
                    __metadata('design:paramtypes', [core_1.ElementRef])
                ], SearchFilterComponent);
                return SearchFilterComponent;
            }());
            exports_1("SearchFilterComponent", SearchFilterComponent);
        }
    }
});
//# sourceMappingURL=filter.component.js.map