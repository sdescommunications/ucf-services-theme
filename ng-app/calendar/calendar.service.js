System.register(["@angular/core", "@angular/http", "rxjs/Observable", "rxjs/add/operator/catch"], function(exports_1, context_1) {
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
    var CalendarService;
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
            function (_1) {}],
        execute: function() {
            CalendarService = (function () {
                function CalendarService(_http) {
                    this._http = _http;
                    window.ucf_svc_calendarService = (window.ucf_svc_calendarService || []).concat(this);
                }
                /**
                 * Fetch calendar events from a datasource.
                 */
                CalendarService.prototype.getCalendarEvents = function () {
                    return Observable_1.Observable.from(window.ucf_calendar_events);
                };
                ;
                CalendarService = __decorate([
                    core_1.Injectable(), 
                    __metadata('design:paramtypes', [http_1.Http])
                ], CalendarService);
                return CalendarService;
            }());
            exports_1("CalendarService", CalendarService);
        }
    }
});
//# sourceMappingURL=calendar.service.js.map