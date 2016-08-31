import { Pipe, PipeTransform } from "@angular/core";

/**
 * Unescape html entities.
 */
@Pipe({
  "name": "unescapeHtml"
})
export class UnescapeHtmlPipe implements PipeTransform {
    protected static entityMap = {
        "&amp;"  : "&",
        "&lt;"   : "<",
        "&gt;"   : ">",
        "&quot;" : "\"",
        "&apos;" : "'",
        "&#39;"  : "'",
        "&#x2F;" : "/"
    };

    transform( toFilter: string, args: string[] = [""] ): any {
        if ( null === toFilter ) return "";
        let viaMethod: string = args[0] ? args[0] : "";

        switch ( viaMethod ) {
            case "manual":
                return this.viaReplacement( toFilter, args );
            case "core-js":
                return toFilter.unescapeHTML();
            case "dom":
            default:
                return this.viaDom( toFilter, args );
        }
    }

    // http://stackoverflow.com/questions/1912501/unescape-html-entities-in-javascript/1912522#1912522
    viaDom( toFilter: string, args: string[] ): any {
        let el = document.createElement( "span" );
        el.innerHTML = toFilter;
        return el.innerHTML;
    }

    // http://stackoverflow.com/questions/14462612/escape-html-text-in-an-angularjs-directive/28537958#28537958
    viaReplacement( toFilter: string, args: string[] ): string {
        /* Regex for HTML Entity: /\(&[\w#]+;\)/g
         * /  - open regex
         * \& - substring starting with an ampersand
         * [\w#]+ - One or more (+) characthers that are a word (\w) or octothrope (#).
         * /g - close regex, search global
         */
        return String( toFilter ).replace( /\&[\w#]+;/g, function (s) {
            return UnescapeHtmlPipe.entityMap[s];
        });
    }
}
window.ucf_pipe_unescapeHtml = UnescapeHtmlPipe;
