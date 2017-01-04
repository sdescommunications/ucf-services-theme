System.config({
  // Set System.baseURL in calling code, before calls to System.import.
  defaultJSExtensions: true,
  transpiler: false,
  babelOptions: {
    "optional": [
      "runtime",
      "optimisation.modules.system"
    ]
  },
  paths: {
    "npm:*": "https://unpkg.com/*",
    "cdnjs:*": "https://cdnjs.cloudflare.com/ajax/libs/*",
    "github:*": "https://github.jspm.io/*",
    "npm_j:*": "https://npm.jspm.io/*"
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
      "main": "moment.js/2.15.1/moment.js"
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

  depCache: {
    "main.js": [
      "ie-shim",
      "@angular/platform-browser-dynamic",
      "@angular/core",
      "./app.module",
      "zone.js/dist/zone"
    ],
    "app.module.js": [
      "@angular/core",
      "@angular/platform-browser",
      "@angular/forms",
      "@angular/http",
      "ng2-bootstrap",
      "./app-student-services/app-student-services.component",
      "./app-student-services/search",
      "./calendar/calendar.component",
      "./calendar/calendar.service",
      "./campaign/campaign.component",
      "./pipes/unescapeHtml.pipe"
    ],
    "npm:@angular/platform-browser-dynamic@2.1.0//bundles/platform-browser-dynamic.umd.js": [
      "@angular/compiler",
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:@angular/core@2.1.0//bundles/core.umd.js": [
      "rxjs/Subject",
      "rxjs/Observable",
      "process"
    ],
    "app-student-services/app-student-services.component.js": [
      "@angular/core",
      "./search"
    ],
    "app-student-services/search.js": [
      "./search/filter",
      "./search/form",
      "./search/results",
      "./search/service"
    ],
    "calendar/calendar.service.js": [
      "@angular/core",
      "@angular/http",
      "rxjs/Observable",
      "rxjs/add/operator/catch"
    ],
    "calendar/calendar.component.js": [
      "@angular/core",
      "moment",
      "./calendar.service"
    ],
    "campaign/campaign.component.js": [
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:@angular/platform-browser@2.1.0//bundles/platform-browser.umd.js": [
      "@angular/common",
      "@angular/core",
      "process"
    ],
    "npm:@angular/http@2.1.0//bundles/http.umd.js": [
      "@angular/core",
      "rxjs/Observable",
      "@angular/platform-browser"
    ],
    "npm:@angular/forms@2.1.0//bundles/forms.umd.js": [
      "@angular/core",
      "rxjs/operator/toPromise",
      "rxjs/Subject",
      "rxjs/Observable",
      "rxjs/observable/fromPromise",
      "process"
    ],
    "pipes/unescapeHtml.pipe.js": [
      "@angular/core"
    ],
    "npm:@angular/compiler@2.1.0//bundles/compiler.umd.js": [
      "@angular/core",
      "process"
    ],
    "github:jspm/nodelibs-process@0.1.2.js": [
      "github:jspm/nodelibs-process@0.1.2/index"
    ],
    "app-student-services/search/filter.js": [
      "./filter/filter.component"
    ],
    "app-student-services/search/form.js": [
      "./form/form.component"
    ],
    "app-student-services/search/results.js": [
      "./results/results.component"
    ],
    "app-student-services/search/service.js": [
      "./service/search.service"
    ],
    "npm:@angular/common@2.1.0//bundles/common.umd.js": [
      "@angular/core"
    ],
    "github:jspm/nodelibs-process@0.1.2/index.js": [
      "process"
    ],
    "app-student-services/search/filter/filter.component.js": [
      "@angular/core"
    ],
    "app-student-services/search/form/form.component.js": [
      "@angular/core",
      "rxjs/Observable",
      "rxjs/add/observable/fromEvent",
      "rxjs/add/operator/map",
      "rxjs/add/operator/debounceTime",
      "rxjs/add/operator/distinctUntilChanged"
    ],
    "app-student-services/search/results/results.component.js": [
      "@angular/core",
      "../service"
    ],
    "app-student-services/search/service/search.service.js": [
      "@angular/core",
      "@angular/http",
      "rxjs/Observable",
      "rxjs/add/operator/map",
      "rxjs/add/operator/do",
      "rxjs/add/operator/catch"
    ],
    "npm:@angular/platform-browser-dynamic@2.2.4//bundles/platform-browser-dynamic.umd.js": [
      "@angular/compiler",
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:@angular/core@2.2.4//bundles/core.umd.js": [
      "rxjs/Subject",
      "rxjs/Observable",
      "process"
    ],
    "npm:@angular/platform-browser@2.2.4//bundles/platform-browser.umd.js": [
      "@angular/common",
      "@angular/core",
      "process"
    ],
    "npm:@angular/forms@2.2.4//bundles/forms.umd.js": [
      "@angular/core",
      "rxjs/operator/toPromise",
      "rxjs/Subject",
      "rxjs/Observable",
      "rxjs/observable/fromPromise",
      "process"
    ],
    "npm:@angular/http@2.2.4//bundles/http.umd.js": [
      "@angular/core",
      "rxjs/Observable",
      "@angular/platform-browser"
    ],
    "npm:@angular/compiler@2.2.4//bundles/compiler.umd.js": [
      "@angular/core",
      "process"
    ],
    "npm:@angular/platform-browser-dynamic@2.4.1//bundles/platform-browser-dynamic.umd.js": [
      "@angular/compiler",
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:@angular/core@2.4.1//bundles/core.umd.js": [
      "rxjs/Subject",
      "rxjs/Observable",
      "process"
    ],
    "npm:@angular/platform-browser@2.4.1//bundles/platform-browser.umd.js": [
      "@angular/common",
      "@angular/core",
      "process"
    ],
    "npm:@angular/http@2.4.1//bundles/http.umd.js": [
      "@angular/core",
      "rxjs/Observable",
      "@angular/platform-browser"
    ],
    "npm:rxjs@5.0.1/Observable.js": [
      "./util/root",
      "./util/toSubscriber",
      "./symbol/observable"
    ],
    "npm:rxjs@5.0.1/Subject.js": [
      "./Observable",
      "./Subscriber",
      "./Subscription",
      "./util/ObjectUnsubscribedError",
      "./SubjectSubscription",
      "./symbol/rxSubscriber"
    ],
    "npm:@angular/forms@2.4.1//bundles/forms.umd.js": [
      "@angular/core",
      "rxjs/operator/toPromise",
      "rxjs/Subject",
      "rxjs/Observable",
      "rxjs/observable/fromPromise",
      "process"
    ],
    "npm:@angular/compiler@2.4.1//bundles/compiler.umd.js": [
      "@angular/core",
      "process"
    ],
    "npm:rxjs@5.0.1/util/toSubscriber.js": [
      "../Subscriber",
      "../symbol/rxSubscriber",
      "../Observer"
    ],
    "npm:rxjs@5.0.1/add/operator/catch.js": [
      "../../Observable",
      "../../operator/catch"
    ],
    "npm:rxjs@5.0.1/symbol/observable.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.1/Subscriber.js": [
      "./util/isFunction",
      "./Subscription",
      "./Observer",
      "./symbol/rxSubscriber"
    ],
    "npm:rxjs@5.0.1/SubjectSubscription.js": [
      "./Subscription"
    ],
    "npm:rxjs@5.0.1/symbol/rxSubscriber.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.1/observable/fromPromise.js": [
      "./PromiseObservable"
    ],
    "npm:rxjs@5.0.1/operator/toPromise.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.1/Subscription.js": [
      "./util/isArray",
      "./util/isObject",
      "./util/isFunction",
      "./util/tryCatch",
      "./util/errorObject",
      "./util/UnsubscriptionError",
      "process"
    ],
    "npm:@angular/common@2.4.1//bundles/common.umd.js": [
      "@angular/core"
    ],
    "npm:rxjs@5.0.1/operator/catch.js": [
      "../OuterSubscriber",
      "../util/subscribeToResult"
    ],
    "npm:rxjs@5.0.1/observable/PromiseObservable.js": [
      "../util/root",
      "../Observable"
    ],
    "npm:rxjs@5.0.1/util/tryCatch.js": [
      "./errorObject"
    ],
    "npm:rxjs@5.0.1/add/observable/fromEvent.js": [
      "../../Observable",
      "../../observable/fromEvent"
    ],
    "npm:rxjs@5.0.1/add/operator/debounceTime.js": [
      "../../Observable",
      "../../operator/debounceTime"
    ],
    "npm:rxjs@5.0.1/add/operator/distinctUntilChanged.js": [
      "../../Observable",
      "../../operator/distinctUntilChanged"
    ],
    "npm:rxjs@5.0.1/add/operator/do.js": [
      "../../Observable",
      "../../operator/do"
    ],
    "npm:rxjs@5.0.1/add/operator/map.js": [
      "../../Observable",
      "../../operator/map"
    ],
    "npm:rxjs@5.0.1/OuterSubscriber.js": [
      "./Subscriber"
    ],
    "npm:rxjs@5.0.1/util/subscribeToResult.js": [
      "./root",
      "./isArray",
      "./isPromise",
      "./isObject",
      "../Observable",
      "../symbol/iterator",
      "../InnerSubscriber",
      "../symbol/observable"
    ],
    "npm:rxjs@5.0.1/add/observable/from.js": [
      "../../Observable",
      "../../observable/from"
    ],
    "npm:rxjs@5.0.1/add/operator/filter.js": [
      "../../Observable",
      "../../operator/filter"
    ],
    "npm:rxjs@5.0.1/add/operator/mergeMap.js": [
      "../../Observable",
      "../../operator/mergeMap"
    ],
    "npm:rxjs@5.0.1/add/operator/toArray.js": [
      "../../Observable",
      "../../operator/toArray"
    ],
    "npm:rxjs@5.0.1/observable/fromEvent.js": [
      "./FromEventObservable"
    ],
    "npm:rxjs@5.0.1/operator/do.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.1/operator/debounceTime.js": [
      "../Subscriber",
      "../scheduler/async"
    ],
    "npm:rxjs@5.0.1/InnerSubscriber.js": [
      "./Subscriber"
    ],
    "npm:rxjs@5.0.1/operator/distinctUntilChanged.js": [
      "../Subscriber",
      "../util/tryCatch",
      "../util/errorObject"
    ],
    "npm:rxjs@5.0.1/operator/map.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.1/symbol/iterator.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.1/observable/from.js": [
      "./FromObservable"
    ],
    "npm:rxjs@5.0.1/operator/filter.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.1/operator/toArray.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.1/operator/mergeMap.js": [
      "../util/subscribeToResult",
      "../OuterSubscriber"
    ],
    "npm:rxjs@5.0.1/observable/FromEventObservable.js": [
      "../Observable",
      "../util/tryCatch",
      "../util/isFunction",
      "../util/errorObject",
      "../Subscription",
      "process"
    ],
    "npm:rxjs@5.0.1/scheduler/async.js": [
      "./AsyncAction",
      "./AsyncScheduler"
    ],
    "npm:rxjs@5.0.1/observable/FromObservable.js": [
      "../util/isArray",
      "../util/isPromise",
      "./PromiseObservable",
      "./IteratorObservable",
      "./ArrayObservable",
      "./ArrayLikeObservable",
      "../symbol/iterator",
      "../Observable",
      "../operator/observeOn",
      "../symbol/observable"
    ],
    "npm:rxjs@5.0.1/scheduler/AsyncAction.js": [
      "../util/root",
      "./Action"
    ],
    "npm:rxjs@5.0.1/observable/ArrayObservable.js": [
      "../Observable",
      "./ScalarObservable",
      "./EmptyObservable",
      "../util/isScheduler"
    ],
    "npm:rxjs@5.0.1/observable/IteratorObservable.js": [
      "../util/root",
      "../Observable",
      "../symbol/iterator"
    ],
    "npm:rxjs@5.0.1/scheduler/AsyncScheduler.js": [
      "../Scheduler"
    ],
    "npm:rxjs@5.0.1/observable/ArrayLikeObservable.js": [
      "../Observable",
      "./ScalarObservable",
      "./EmptyObservable"
    ],
    "npm:rxjs@5.0.1/operator/observeOn.js": [
      "../Subscriber",
      "../Notification"
    ],
    "npm:rxjs@5.0.1/observable/ScalarObservable.js": [
      "../Observable"
    ],
    "npm:rxjs@5.0.1/scheduler/Action.js": [
      "../Subscription"
    ],
    "npm:rxjs@5.0.1/observable/EmptyObservable.js": [
      "../Observable"
    ],
    "npm:rxjs@5.0.1/Scheduler.js": [
      "process"
    ],
    "npm:rxjs@5.0.1/Notification.js": [
      "./Observable"
    ],
    "npm:zone.js@0.7.4/dist/zone.js": [
      "process"
    ],
    "npm:ie-shim@0.1.0.js": [
      "./ie-shim@0.1.0/index"
    ],
    "npm:ng2-bootstrap@1.1.16-11.js": [
      "npm:ng2-bootstrap@1.1.16-11/bundles/ng2-bootstrap.umd.js"
    ],
    "npm:ng2-bootstrap@1.1.16-11/bundles/ng2-bootstrap.umd.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "rxjs/Observable",
      "rxjs/add/observable/from",
      "rxjs/add/operator/debounceTime",
      "rxjs/add/operator/filter",
      "rxjs/add/operator/map",
      "rxjs/add/operator/mergeMap",
      "rxjs/add/operator/toArray",
      "process"
    ],
    "npm:process@0.11.9.js": [
      "npm:process@0.11.9/browser.js"
    ]
  },

  map: {
    "@angular": "npm:@angular",
    "@angular/common": "npm:@angular/common@2.4.1",
    "@angular/compiler": "npm:@angular/compiler@2.4.1",
    "@angular/core": "npm:@angular/core@2.4.1",
    "@angular/forms": "npm:@angular/forms@2.4.1",
    "@angular/http": "npm:@angular/http@2.4.1",
    "@angular/platform-browser": "npm:@angular/platform-browser@2.4.1",
    "@angular/platform-browser-dynamic": "npm:@angular/platform-browser-dynamic@2.4.1",
    "@angular/router": "npm:@angular/router",
    "@angular/upgrade": "npm:@angular/upgrade@2.4.1",
    "angular/angular": "github:angular/angular@2.1.0",
    "app": "",
    "babel": "npm:babel-core@5.8.38",
    "babel-runtime": "npm:babel-runtime@5.8.38",
    "core-js": "npm:core-js@2.4.1",
    "ie-shim": "npm:ie-shim@0.1.0",
    "main": "",
    "moment": "npm:moment@2.15.1",
    "ng2-bootstrap": "npm:ng2-bootstrap@1.1.16-11",
    "process": "npm:process@0.11.9.js",
    "reflect-metadata": "npm:reflect-metadata@0.1.3",
    "rxjs": "npm:rxjs@5.0.1",
    "zone.js": "npm:zone.js@0.7.4",
    "github:jspm/nodelibs-assert@0.1.0": {
      "assert": "npm:assert@1.4.1"
    },
    "github:jspm/nodelibs-buffer@0.1.0": {
      "buffer": "npm:buffer@3.6.0"
    },
    "github:jspm/nodelibs-constants@0.1.0": {
      "constants-browserify": "npm:constants-browserify@0.0.1"
    },
    "github:jspm/nodelibs-crypto@0.1.0": {
      "crypto-browserify": "npm:crypto-browserify@3.11.0"
    },
    "github:jspm/nodelibs-events@0.1.1": {
      "events": "npm:events@1.0.2"
    },
    "github:jspm/nodelibs-path@0.1.0": {
      "path-browserify": "npm:path-browserify@0.0.0"
    },
    "github:jspm/nodelibs-process@0.1.2": {
      "process": "npm:process@0.11.9"
    },
    "github:jspm/nodelibs-stream@0.1.0": {
      "stream-browserify": "npm:stream-browserify@1.0.0"
    },
    "github:jspm/nodelibs-string_decoder@0.1.0": {
      "string_decoder": "npm:string_decoder@0.10.31"
    },
    "github:jspm/nodelibs-timers@0.1.0": {
      "timers-browserify": "npm:timers-browserify@1.4.2"
    },
    "github:jspm/nodelibs-util@0.1.0": {
      "util": "npm:util@0.10.3"
    },
    "github:jspm/nodelibs-vm@0.1.0": {
      "vm-browserify": "npm:vm-browserify@0.0.4"
    },
    "npm:@angular/common@2.4.1": {
      "@angular/core": "npm:@angular/core@2.4.1"
    },
    "npm:@angular/compiler@2.4.1": {
      "@angular/core": "npm:@angular/core@2.4.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/core@2.4.1": {
      "process": "github:jspm/nodelibs-process@0.1.2",
      "rxjs": "npm:rxjs@5.0.1",
      "zone.js": "npm:zone.js@0.7.4"
    },
    "npm:@angular/forms@2.4.1": {
      "@angular/common": "npm:@angular/common@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/http@2.4.1": {
      "@angular/core": "npm:@angular/core@2.4.1",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.4.1",
      "rxjs": "npm:rxjs@5.0.1"
    },
    "npm:@angular/platform-browser-dynamic@2.4.1": {
      "@angular/common": "npm:@angular/common@2.4.1",
      "@angular/compiler": "npm:@angular/compiler@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.4.1"
    },
    "npm:@angular/platform-browser@2.4.1": {
      "@angular/common": "npm:@angular/common@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/upgrade@2.4.1": {
      "@angular/compiler": "npm:@angular/compiler@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.4.1",
      "@angular/platform-browser-dynamic": "npm:@angular/platform-browser-dynamic@2.4.1"
    },
    "npm:asn1.js@4.9.1": {
      "bn.js": "npm:bn.js@4.11.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "inherits": "npm:inherits@2.0.1",
      "minimalistic-assert": "npm:minimalistic-assert@1.0.0",
      "vm": "github:jspm/nodelibs-vm@0.1.0"
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
    "npm:bn.js@4.11.6": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0"
    },
    "npm:browserify-aes@1.0.6": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "buffer-xor": "npm:buffer-xor@1.0.3",
      "cipher-base": "npm:cipher-base@1.0.3",
      "create-hash": "npm:create-hash@1.1.2",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "evp_bytestokey": "npm:evp_bytestokey@1.0.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "inherits": "npm:inherits@2.0.1",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:browserify-cipher@1.0.0": {
      "browserify-aes": "npm:browserify-aes@1.0.6",
      "browserify-des": "npm:browserify-des@1.0.0",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "evp_bytestokey": "npm:evp_bytestokey@1.0.0"
    },
    "npm:browserify-des@1.0.0": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "cipher-base": "npm:cipher-base@1.0.3",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "des.js": "npm:des.js@1.0.0",
      "inherits": "npm:inherits@2.0.1"
    },
    "npm:browserify-rsa@4.0.1": {
      "bn.js": "npm:bn.js@4.11.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "constants": "github:jspm/nodelibs-constants@0.1.0",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "randombytes": "npm:randombytes@2.0.3"
    },
    "npm:browserify-sign@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "browserify-rsa": "npm:browserify-rsa@4.0.1",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "create-hmac": "npm:create-hmac@1.1.4",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "elliptic": "npm:elliptic@6.3.2",
      "inherits": "npm:inherits@2.0.1",
      "parse-asn1": "npm:parse-asn1@5.0.0",
      "stream": "github:jspm/nodelibs-stream@0.1.0"
    },
    "npm:buffer-xor@1.0.3": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:buffer@3.6.0": {
      "base64-js": "npm:base64-js@0.0.8",
      "child_process": "github:jspm/nodelibs-child_process@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "ieee754": "npm:ieee754@1.1.8",
      "isarray": "npm:isarray@1.0.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:cipher-base@1.0.3": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "inherits": "npm:inherits@2.0.1",
      "stream": "github:jspm/nodelibs-stream@0.1.0",
      "string_decoder": "github:jspm/nodelibs-string_decoder@0.1.0"
    },
    "npm:constants-browserify@0.0.1": {
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:core-js@2.4.1": {
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "path": "github:jspm/nodelibs-path@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:core-util-is@1.0.2": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0"
    },
    "npm:create-ecdh@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "elliptic": "npm:elliptic@6.3.2"
    },
    "npm:create-hash@1.1.2": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "cipher-base": "npm:cipher-base@1.0.3",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "inherits": "npm:inherits@2.0.1",
      "ripemd160": "npm:ripemd160@1.0.1",
      "sha.js": "npm:sha.js@2.4.8"
    },
    "npm:create-hmac@1.1.4": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "inherits": "npm:inherits@2.0.1",
      "stream": "github:jspm/nodelibs-stream@0.1.0"
    },
    "npm:crypto-browserify@3.11.0": {
      "browserify-cipher": "npm:browserify-cipher@1.0.0",
      "browserify-sign": "npm:browserify-sign@4.0.0",
      "create-ecdh": "npm:create-ecdh@4.0.0",
      "create-hash": "npm:create-hash@1.1.2",
      "create-hmac": "npm:create-hmac@1.1.4",
      "diffie-hellman": "npm:diffie-hellman@5.0.2",
      "inherits": "npm:inherits@2.0.1",
      "pbkdf2": "npm:pbkdf2@3.0.9",
      "public-encrypt": "npm:public-encrypt@4.0.0",
      "randombytes": "npm:randombytes@2.0.3"
    },
    "npm:des.js@1.0.0": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "inherits": "npm:inherits@2.0.1",
      "minimalistic-assert": "npm:minimalistic-assert@1.0.0"
    },
    "npm:diffie-hellman@5.0.2": {
      "bn.js": "npm:bn.js@4.11.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "miller-rabin": "npm:miller-rabin@4.0.0",
      "randombytes": "npm:randombytes@2.0.3",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:elliptic@6.3.2": {
      "bn.js": "npm:bn.js@4.11.6",
      "brorand": "npm:brorand@1.0.6",
      "hash.js": "npm:hash.js@1.0.3",
      "inherits": "npm:inherits@2.0.1",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:evp_bytestokey@1.0.0": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0"
    },
    "npm:hash.js@1.0.3": {
      "inherits": "npm:inherits@2.0.1"
    },
    "npm:ie-shim@0.1.0": {
      "path": "github:jspm/nodelibs-path@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:inherits@2.0.1": {
      "util": "github:jspm/nodelibs-util@0.1.0"
    },
    "npm:miller-rabin@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "brorand": "npm:brorand@1.0.6"
    },
    "npm:ng2-bootstrap@1.1.16-11": {
      "@angular/common": "npm:@angular/common@2.4.1",
      "@angular/compiler": "npm:@angular/compiler@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "@angular/forms": "npm:@angular/forms@2.4.1",
      "moment": "npm:moment@2.17.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:parse-asn1@5.0.0": {
      "asn1.js": "npm:asn1.js@4.9.1",
      "browserify-aes": "npm:browserify-aes@1.0.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "evp_bytestokey": "npm:evp_bytestokey@1.0.0",
      "pbkdf2": "npm:pbkdf2@3.0.9",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:path-browserify@0.0.0": {
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:pbkdf2@3.0.9": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hmac": "npm:create-hmac@1.1.4",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:process@0.11.9": {
      "assert": "github:jspm/nodelibs-assert@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "vm": "github:jspm/nodelibs-vm@0.1.0"
    },
    "npm:public-encrypt@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "browserify-rsa": "npm:browserify-rsa@4.0.1",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "parse-asn1": "npm:parse-asn1@5.0.0",
      "randombytes": "npm:randombytes@2.0.3"
    },
    "npm:randombytes@2.0.3": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:readable-stream@1.1.14": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "core-util-is": "npm:core-util-is@1.0.2",
      "events": "github:jspm/nodelibs-events@0.1.1",
      "inherits": "npm:inherits@2.0.1",
      "isarray": "npm:isarray@0.0.1",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "stream-browserify": "npm:stream-browserify@1.0.0",
      "string_decoder": "npm:string_decoder@0.10.31"
    },
    "npm:ripemd160@1.0.1": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:rxjs@5.0.1": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "symbol-observable": "npm:symbol-observable@1.0.4"
    },
    "npm:sha.js@2.4.8": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "inherits": "npm:inherits@2.0.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:stream-browserify@1.0.0": {
      "events": "github:jspm/nodelibs-events@0.1.1",
      "inherits": "npm:inherits@2.0.1",
      "readable-stream": "npm:readable-stream@1.1.14"
    },
    "npm:string_decoder@0.10.31": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0"
    },
    "npm:timers-browserify@1.4.2": {
      "process": "npm:process@0.11.9"
    },
    "npm:util@0.10.3": {
      "inherits": "npm:inherits@2.0.1",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:vm-browserify@0.0.4": {
      "indexof": "npm:indexof@0.0.1"
    },
    "npm:zone.js@0.7.4": {
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "events": "github:jspm/nodelibs-events@0.1.1",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "timers": "github:jspm/nodelibs-timers@0.1.0"
    }
  }
});
