System.config({
  baseURL: configjs.baseURL,  // Set configjs.baseURL in calling code, e.g., via wp_localize_script().
  defaultJSExtensions: true,
  transpiler: false,
  babelOptions: {
    "optional": [
      "runtime",
      "optimisation.modules.system"
    ]
  },
  paths: {
    "unpkg:*": "https://unpkg.com/*",
    "cdnjs:*": "https://cdnjs.cloudflare.com/ajax/libs/*",
    "github:*": "https://github.jspm.io/*",
    "npm:*": "https://npm.jspm.io/*"
  },

  packages: {
    "app": {
      "main": "main",
      "defaultExtension": "js"
    },
    "main": {
      "main": "main",
      "defaultExtension": "js"
    },
    "moment": {
      "main": "moment.js/2.14.1/moment.js"
    },
    "rxjs": {
      "defaultExtension": "js"
    },
    "@angular/common": {
      "main": "/bundles/common.umd.js",
      "defaultExtension": "js"
    },
    "@angular/compiler": {
      "main": "/bundles/compiler.umd.js",
      "defaultExtension": "js"
    },
    "@angular/core": {
      "main": "/bundles/core.umd.js",
      "defaultExtension": "js"
    },
    "@angular/forms": {
      "main": "/bundles/forms.umd.js",
      "defaultExtension": "js"
    },
    "@angular/http": {
      "main": "/bundles/http.umd.js",
      "defaultExtension": "js"
    },
    "@angular/platform-browser": {
      "main": "/bundles/platform-browser.umd.js",
      "defaultExtension": "js"
    },
    "@angular/platform-browser-dynamic": {
      "main": "/bundles/platform-browser-dynamic.umd.js",
      "defaultExtension": "js"
    },
    "@angular/router": {
      "main": "index.js",
      "defaultExtension": "js"
    },
    "@angular/router-deprecated": {
      "main": "/bundles/router-deprecated.umd.js",
      "defaultExtension": "js"
    },
    "@angular/upgrade": {
      "main": "/bundles/upgrade.umd.js",
      "defaultExtension": "js"
    }
  },

  map: {
    "@angular": "unpkg:@angular",
    "@angular/common": "unpkg:@angular/common@2.0.0-rc.6",
    "@angular/compiler": "unpkg:@angular/compiler@2.0.0-rc.6",
    "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
    "@angular/forms": "unpkg:@angular/forms@2.0.0-rc.6",
    "@angular/http": "unpkg:@angular/http@2.0.0-rc.6",
    "@angular/platform-browser": "unpkg:@angular/platform-browser@2.0.0-rc.6",
    "@angular/platform-browser-dynamic": "unpkg:@angular/platform-browser-dynamic@2.0.0-rc.6",
    "@angular/router": "unpkg:@angular/router",
    "@angular/upgrade": "unpkg:@angular/upgrade@2.0.0-rc.6",
    "angular/angular": "github:angular/angular@2.0.0-rc.6",
    "app": "",
    "babel": "npm:babel-core@5.8.38",
    "babel-runtime": "npm:babel-runtime@5.8.38",
    "core-js": "npm:core-js@2.4.0",
    "main": "",
    "moment": "cdnjs:moment.js/2.14.1/moment.min.js",
    "ng2-bootstrap": "cdnjs:ng2-bootstrap/1.1.1/ng2-bootstrap.min.js",
    "reflect-metadata": "npm:reflect-metadata@0.1.3",
    "rxjs": "unpkg:rxjs@5.0.0-beta.11",
    "zone.js": "npm:zone.js@0.6.17",
    "github:jspm/nodelibs-assert@0.1.0": {
      "assert": "npm:assert@1.4.1"
    },
    "github:jspm/nodelibs-buffer@0.1.0": {
      "buffer": "npm:buffer@3.6.0"
    },
    "github:jspm/nodelibs-path@0.1.0": {
      "path-browserify": "npm:path-browserify@0.0.0"
    },
    "github:jspm/nodelibs-process@0.1.2": {
      "process": "npm:process@0.11.9"
    },
    "github:jspm/nodelibs-util@0.1.0": {
      "util": "npm:util@0.10.3"
    },
    "github:jspm/nodelibs-vm@0.1.0": {
      "vm-browserify": "npm:vm-browserify@0.0.4"
    },
    "unpkg:@angular/common@2.0.0-rc.6": {
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6"
    },
    "unpkg:@angular/compiler@2.0.0-rc.6": {
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "unpkg:@angular/core@2.0.0-rc.6": {
      "process": "github:jspm/nodelibs-process@0.1.2",
      "rxjs": "unpkg:rxjs@5.0.0-beta.11",
      "zone.js": "npm:zone.js@0.6.17"
    },
    "unpkg:@angular/forms@2.0.0-rc.6": {
      "@angular/common": "unpkg:@angular/common@2.0.0-rc.6",
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "unpkg:@angular/http@2.0.0-rc.6": {
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "@angular/platform-browser": "unpkg:@angular/platform-browser@2.0.0-rc.6",
      "rxjs": "unpkg:rxjs@5.0.0-beta.11"
    },
    "unpkg:@angular/platform-browser-dynamic@2.0.0-rc.6": {
      "@angular/common": "unpkg:@angular/common@2.0.0-rc.6",
      "@angular/compiler": "unpkg:@angular/compiler@2.0.0-rc.6",
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "@angular/platform-browser": "unpkg:@angular/platform-browser@2.0.0-rc.6"
    },
    "unpkg:@angular/platform-browser@2.0.0-rc.6": {
      "@angular/common": "unpkg:@angular/common@2.0.0-rc.6",
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "unpkg:@angular/upgrade@2.0.0-rc.6": {
      "@angular/compiler": "unpkg:@angular/compiler@2.0.0-rc.6",
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "@angular/platform-browser": "unpkg:@angular/platform-browser@2.0.0-rc.6",
      "@angular/platform-browser-dynamic": "unpkg:@angular/platform-browser-dynamic@2.0.0-rc.6"
    },
    "npm:assert@1.4.1": {
      "assert": "github:jspm/nodelibs-assert@0.1.0",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "util": "npm:util@0.10.3"
    },
    "npm:babel-runtime@5.8.38": {
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:buffer@3.6.0": {
      "base64-js": "npm:base64-js@0.0.8",
      "child_process": "github:jspm/nodelibs-child_process@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "ieee754": "npm:ieee754@1.1.6",
      "isarray": "npm:isarray@1.0.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:core-js@2.4.0": {
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "path": "github:jspm/nodelibs-path@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:inherits@2.0.1": {
      "util": "github:jspm/nodelibs-util@0.1.0"
    },
    "npm:ng2-bootstrap@1.1.1": {
      "@angular/common": "unpkg:@angular/common@2.0.0-rc.6",
      "@angular/compiler": "unpkg:@angular/compiler@2.0.0-rc.6",
      "@angular/core": "unpkg:@angular/core@2.0.0-rc.6",
      "@angular/forms": "unpkg:@angular/forms@2.0.0-rc.6",
      "moment": "npm:moment@2.14.1"
    },
    "npm:path-browserify@0.0.0": {
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:process@0.11.9": {
      "assert": "github:jspm/nodelibs-assert@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "vm": "github:jspm/nodelibs-vm@0.1.0"
    },
    "unpkg:rxjs@5.0.0-beta.11": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "symbol-observable": "npm:symbol-observable@1.0.2"
    },
    "npm:util@0.10.3": {
      "inherits": "npm:inherits@2.0.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:vm-browserify@0.0.4": {
      "indexof": "npm:indexof@0.0.1"
    },
    "npm:zone.js@0.6.17": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    }
  }
});
