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
    var CampaignComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (unescapeHtml_pipe_1_1) {
                unescapeHtml_pipe_1 = unescapeHtml_pipe_1_1;
            }],
        execute: function() {
            CampaignComponent = (function () {
                function CampaignComponent() {
                    this.type = "square";
                    window.ucf_comp_campaign = (window.ucf_comp_campaign || []).concat(this);
                    this.image_url = (this.image_url) ? this.image_url : "#";
                    this.url = (this.url) ? this.url : "#";
                    this.title = (this.title) ? this.title : "Title";
                    this.long = (this.long) ? this.long : "A long description of this campaign.";
                    this.short = (this.short) ? this.short : "Short text.";
                    this.btn_text = (this.btn_text) ? this.btn_text : "More";
                }
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "type", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "image_url", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "url", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "title", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "long", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "short", void 0);
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], CampaignComponent.prototype, "btn_text", void 0);
                CampaignComponent = __decorate([
                    core_1.Component({
                        selector: "ucf-campaign",
                        moduleId: __moduleName,
                        // templateUrl: "./campaign.component.html",
                        template: "<div class=\"container-fluid\" *ngIf='type == \"rectangle\"'>\n            <div class=\"row campaign\" style=\"background-image: url( {{ image_url | unescapeHtml }} );\"> <!-- primary bg -->\n                <div class=\"col-sm-6 col-md-offset-6 campaign-content\">\n                    <div class=\"campaign-title\">\n                        <a href=\"{{ url }}\">{{ title }}</a>\n                    </div>\n                    <p>{{ long }}</p>\n                    <a href=\"{{ url }}\">\n                        <span class=\"btn btn-default btn-lg\" type=\"button\">\n                            {{ btn_text }}\n                        </span>\n                    </a>\n                </div>\n            </div>\n        </div>\n\n        <div class=\"campaign\" style=\"background: #f3f3f3;\" *ngIf='type == \"square\"'>\n            <div class=\"campaign-content\">\n                <div class=\"campaign-title\">\n                    <a href=\"{{ url }}\">{{ title }}</a>\n                </div>\n                <p>{{ short }}</p>\n                <a href=\"{{ url }}\">\n                    <span class=\"btn btn-default btn-lg\" type=\"button\">\n                        {{ btn_text }}\n                    </span>\n                </a>\n            </div>\n        </div>\n        ",
                        // styleUrls: ["../../scss/_campaign.scss"],
                        // directives: [  ],
                        pipes: [unescapeHtml_pipe_1.UnescapeHtmlPipe],
                    }), 
                    __metadata('design:paramtypes', [])
                ], CampaignComponent);
                return CampaignComponent;
            }());
            exports_1("CampaignComponent", CampaignComponent);
        }
    }
});
//# sourceMappingURL=campaign.component.js.map