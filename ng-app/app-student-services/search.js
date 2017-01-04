System.register(["./search/filter", "./search/form", "./search/results", "./search/service"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function exportStar_1(m) {
        var exports = {};
        for (var n in m) {
            if (n !== "default")
                exports[n] = m[n];
        }
        exports_1(exports);
    }
    return {
        setters: [
            function (filter_1_1) {
                exportStar_1(filter_1_1);
            },
            function (form_1_1) {
                exportStar_1(form_1_1);
            },
            function (results_1_1) {
                exportStar_1(results_1_1);
            },
            function (service_1_1) {
                exportStar_1(service_1_1);
            }
        ],
        execute: function () {
        }
    };
});
//# sourceMappingURL=search.js.map