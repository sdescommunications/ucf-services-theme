import { Component, OnInit, OnChanges, Input } from "@angular/core";

import { UnescapeHtmlPipe } from "pipes/unescapeHtml.pipe";

@Component({
    selector: "ucf-campaign",
    moduleId: __moduleName,
    // templateUrl: "./campaign.component.html",
    template:
        `<div class="container-fluid" *ngIf='type == "rectangle"'>
            <div class="row campaign" style="background-image: url( {{ image_url | unescapeHtml }} );"> <!-- primary bg -->
                <div class="col-sm-6 col-md-offset-6 campaign-content">
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
            <div class="campaign-content">
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
        `,
    // styleUrls: ["../../scss/_campaign.scss"],
    // directives: [  ],
    pipes: [ UnescapeHtmlPipe ],
})
export class CampaignComponent {
    @Input() type: string = "square";
    @Input() image_url: string;
    @Input() url: string;
    @Input() title: string;
    @Input() long: string;
    @Input() short: string;
    @Input() btn_text: string;

    constructor() {
        window.ucf_comp_campaign = ( window.ucf_comp_campaign || [] ).concat( this );
        this.image_url = ( this.image_url ) ? this.image_url : "#";
        this.url = ( this.url ) ? this.url : "#";
        this.title = ( this.title ) ? this.title : "Title";
        this.long = ( this.long ) ? this.long : "A long description of this campaign.";
        this.short = ( this.short ) ? this.short : "Short text.";
        this.btn_text = ( this.btn_text ) ? this.btn_text : "More";
    }

}
