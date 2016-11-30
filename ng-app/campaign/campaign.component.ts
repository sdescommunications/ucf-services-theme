import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { DomSanitizer } from "@angular/platform-browser";

import { ICampaignModel } from "./ICampaignModel";

@Component({
    selector: "ucf-campaign",
    moduleId: __moduleName,
    templateUrl: "./campaign.component.html",
    // styleUrls: ["../../scss/_campaign.scss"],
    // directives: [  ],
    // pipes: [  ],
})
export class CampaignComponent {
    @Input() type: string = "square";
    @Input() image_url: string;
    @Input() url: string;
    @Input() title: string;
    @Input() long: string;
    @Input() short: string;
    @Input() btn_text: string;
    @Input() model: ICampaignModel;
    _shouldHide = false;

    constructor( private sanitizer: DomSanitizer ) {
        window.ucf_comp_campaign = ( window.ucf_comp_campaign || [] ).concat( this );
    }

    ngOnInit() {
        if ( null != this.model ) {
            this.image_url = this.model.image_url;
            this.url = this.model.url;
            this.title = this.model.title;
            this.long = this.model.long;
            this.short = this.model.short;
            this.btn_text = this.model.btn_text;
        }
    }

    hide() {
        this._shouldHide = true;
    }

    shouldShow(): boolean {
        if ( this._shouldHide || "undefined" === typeof this.title || "undefined" === typeof this.btn_text
            || "" === this.title || "" === this.btn_text ) {
            return false;
        }
        return true;
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
// Window from tsserver/lib.d.ts
interface WindowUcfComp extends Window {
    ucf_comp_campaign: CampaignComponent[];
}
declare var window: WindowUcfComp;
