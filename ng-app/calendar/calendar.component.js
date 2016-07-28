System.register(["@angular/core", 'moment', "./calendar.service"], function(exports_1, context_1) {
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
    var core_1, moment_1, calendar_service_1;
    var CalendarEventsComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (moment_1_1) {
                moment_1 = moment_1_1;
            },
            function (calendar_service_1_1) {
                calendar_service_1 = calendar_service_1_1;
            }],
        execute: function() {
            CalendarEventsComponent = (function () {
                function CalendarEventsComponent(_calendarService) {
                    this._calendarService = _calendarService;
                    this.title = "Academic Calendar";
                    this.events = window.ucf_calendar_events; // = [
                    //  { summary: 'An Event', url: '#', dtstart: '2016-07-01 00:00:00Z' },
                    //  { summary: 'Another Event', url: '#', dtstart: '2017-01-01 00:00:00Z' },
                    // ];
                    this.moreEventsLink = '#';
                    this.moreEventsText = 'More Events ›';
                    this.errorMessage = "";
                    window.ucf_comp_calendar = (window.ucf_comp_calendar || []).concat(this);
                }
                CalendarEventsComponent.prototype.ngOnInit = function () {
                    var _this = this;
                    this._calendarService.getCalendarEvents()
                        .subscribe(function (event) { _this.events.concat(event); }, function (error) { _this.errorMessage = error; });
                };
                CalendarEventsComponent.prototype.hasEvents = function () {
                    return 'undefined' != typeof this.events && this.events && this.events.length > 0;
                };
                CalendarEventsComponent.prototype.month_day = function (event) {
                    return moment_1.default(event.dtstart).format("MMM DD");
                };
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CalendarEventsComponent.prototype, "title", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', Array)
                ], CalendarEventsComponent.prototype, "events", void 0);
                __decorate([
                    // = [
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CalendarEventsComponent.prototype, "moreEventsLink", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CalendarEventsComponent.prototype, "moreEventsText", void 0);
                CalendarEventsComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-calendar-events",
                        moduleId: __moduleName,
                        // templateUrl: "./calendar-events.component.html",
                        template: "<div class=\"calendar-events collapsed\" type=\"button\"\n             data-toggle=\"collapse\" data-target=\"#calendar-expand\"\n             aria-expanded=\"true\" aria-controls=\"collapseExample\">\n            <span class=\"calendar-events-title\">\n                <span class=\"fa fa-calendar-o calendar-icon\"></span>\n                {{ title }}\n                <span class=\"fa fa-chevron-down calendar-chevron\"></span>\n            </span>\n            <div class=\"collapse\" id=\"calendar-expand\">\n                <span *ngIf='! hasEvents()'>No events found.</span>\n\n                <div class=\"event\" *ngFor='let event of events'>\n                    <div class=\"title\"><a href=\"{{ event.url }}\">{{ event.summary }}</a></div>\n                    <div class=\"date\">{{ month_day(event) }}</div>\n                </div>\n\n                <div>\n                    <a class=\"all-link external\" href=\"{{ moreEventsLink }}\">{{ moreEventsText }}</a>\n                </div>\n            </div>\n        </div>",
                    }), 
                    __metadata('design:paramtypes', [calendar_service_1.CalendarService])
                ], CalendarEventsComponent);
                return CalendarEventsComponent;
            }());
            exports_1("CalendarEventsComponent", CalendarEventsComponent);
        }
    }
});
//# sourceMappingURL=calendar.component.js.map