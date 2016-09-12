import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { DomSanitizer } from "@angular/platform-browser"

import { ICampaignModel } from "./ICampaignModel";

@Component({
    selector: "ucf-campaign",
    moduleId: __moduleName,
    // templateUrl: "./campaign.component.html",
    template:
        `<div class="container-fluid" *ngIf='type == "rectangle"'>
            <div class="row campaign" *ngIf="shouldShow()">
                <div class="col-sm-5 campaign-image">
                    <img [src]="image_url">
                </div>
                <div class="col-sm-7 campaign-content">
                    <div class="campaign-title">
                        <a href="{{ url }}">{{ title }}</a>
                    </div>
                    <p>{{ long }}</p>
                    <a href="{{ url }}">
                        <span class="btn btn-default btn-lg" type="button">
                            {{ btn_text }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="campaign" style="background: #f3f3f3;" *ngIf='type == "square"'>
            <div class="campaign-content" *ngIf="shouldShow()">
                <div class="campaign-title">
                    <a href="{{ url }}">{{ title }}</a>
                </div>
                <p>{{ short }}</p>
                <a href="{{ url }}">
                    <span class="btn btn-default btn-lg" type="button">
                        {{ btn_text }}
                    </span>
                </a>
            </div>
        </div>
        <span class="campaign-invalid" *ngIf="!shouldShow()"><!-- Invalid Campaign --></span>
        `,
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

    constructor( private sanitizer: DomSanitizer ) {
        window.ucf_comp_campaign = ( window.ucf_comp_campaign || [] ).concat( this );
    }

    ngOnInit() {
        if( null != this.model ) {
            this.image_url = this.model.image_url;
            this.url = this.model.url;
            this.title = this.model.title;
            this.long = this.model.long;
            this.short = this.model.short;
            this.btn_text = this.model.btn_text;
        }
    }

    shouldShow(): boolean {
        if ( "undefined" == typeof this.title || "undefined" == typeof this.btn_text
            || "" == this.title || "" == this.btn_text ) {
            return false;
        }
        return true;
    }
}



// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
// Window from tsserver/lib.d.ts
interface Window_ucf_comp extends Window {
    ucf_comp_campaign: CampaignComponent[];
}
declare var window: Window_ucf_comp;
