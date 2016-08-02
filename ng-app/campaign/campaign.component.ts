import { Component, OnInit, OnChanges, Input } from "@angular/core";
import { DomSanitizationService } from "@angular/platform-browser"

@Component({
    selector: "ucf-campaign",
    moduleId: __moduleName,
    // templateUrl: "./campaign.component.html",
    template:
        `<div class="container-fluid" *ngIf='type == "rectangle"'>
            <div class="row campaign" [style.background-image]="background_image"
                 *ngIf="shouldShow()"> <!-- primary bg -->
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
    @Input() model: any;
    background_image: string = `url()`;

    constructor( private sanitizer: DomSanitizationService ) {
        window.ucf_comp_campaign = ( window.ucf_comp_campaign || [] ).concat( this );
    }

    ngOnInit() {
        if( null != this.model && "" != this.model ) {
            this.image_url = this.model.image_url;
            this.url = this.model.url;
            this.title = this.model.title;
            this.long = this.model.long;
            this.short = this.model.short;
            this.btn_text = this.model.btn_text;
        }
        this.background_image = this.sanitizer.bypassSecurityTrustStyle( `url(${this.image_url})` );
    }

    shouldShow(): boolean {
        if ( "undefined" == typeof this.title || "undefined" == typeof this.btn_text
            || "" == this.title || "" == this.btn_text ) {
            return false;
        }
        return true;
    }
}
