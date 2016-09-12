System.register(["@angular/core"], function(exports_1, context_1) {
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
    var core_1;
    var UnescapeHtmlPipe;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            }],
        execute: function() {
            /**
             * Unescape html entities.
             */
            UnescapeHtmlPipe = (function () {
                function UnescapeHtmlPipe() {
                }
                UnescapeHtmlPipe.prototype.transform = function (toFilter, args) {
                    if (args === void 0) { args = [""]; }
                    if (null === toFilter)
                        return "";
                    var viaMethod = args[0] ? args[0] : "";
                    switch (viaMethod) {
                        case "manual":
                            return this.viaReplacement(toFilter, args);
                        case "core-js":
                            return toFilter.unescapeHTML();
                        case "dom":
                        default:
                            return this.viaDom(toFilter, args);
                    }
                };
                // http://stackoverflow.com/questions/1912501/unescape-html-entities-in-javascript/1912522#1912522
                UnescapeHtmlPipe.prototype.viaDom = function (toFilter, args) {
                    var el = document.createElement("span");
                    el.innerHTML = toFilter;
                    return el.innerHTML;
                };
                // http://stackoverflow.com/questions/14462612/escape-html-text-in-an-angularjs-directive/28537958#28537958
                UnescapeHtmlPipe.prototype.viaReplacement = function (toFilter, args) {
                    /* Regex for HTML Entity: /\(&[\w#]+;\)/g
                     * /  - open regex
                     * \& - substring starting with an ampersand
                     * [\w#]+ - One or more (+) characthers that are a word (\w) or octothrope (#).
                     * /g - close regex, search global
                     */
                    return String(toFilter).replace(/\&[\w#]+;/g, function (s) {
                        return UnescapeHtmlPipe.entityMap[s];
                    });
                };
                UnescapeHtmlPipe.entityMap = {
                    "&amp;": "&",
                    "&lt;": "<",
                    "&gt;": ">",
                    "&quot;": "\"",
                    "&apos;": "'",
                    "&#39;": "'",
                    "&#x2F;": "/"
                };
                UnescapeHtmlPipe = __decorate([
                    core_1.Pipe({
                        "name": "unescapeHtml"
                    }), 
                    __metadata('design:paramtypes', [])
                ], UnescapeHtmlPipe);
                return UnescapeHtmlPipe;
            }());
            exports_1("UnescapeHtmlPipe", UnescapeHtmlPipe);
            window.ucf_pipe_unescapeHtml = new UnescapeHtmlPipe();
        }
    }
});
//# sourceMappingURL=unescapeHtml.pipe.js.map