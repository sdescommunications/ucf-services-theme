System.register(["@angular/platform-browser-dynamic", '@angular/core', "./app.module"], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var platform_browser_dynamic_1, core_1, app_module_1;
    return {
        setters:[
            function (platform_browser_dynamic_1_1) {
                platform_browser_dynamic_1 = platform_browser_dynamic_1_1;
            },
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (app_module_1_1) {
                app_module_1 = app_module_1_1;
            }],
        execute: function() {
            core_1.enableProdMode();
            platform_browser_dynamic_1.platformBrowserDynamic().bootstrapModule(app_module_1.AppModule)
                .then(function (comp_ref) {
                window.ucf_app_comp_ref = comp_ref;
                window.ucf_app_instance = comp_ref.instance;
            })
                .catch(function (err) { return console.error(err); });
        }
    }
});
//# sourceMappingURL=main.js.map