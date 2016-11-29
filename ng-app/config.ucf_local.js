window.ucf_local_config = {
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
    "github:*": "jspm_packages/github/*",
    "npm:*": "jspm_packages/npm/*"
  },
  bundles: {
    "bundle-app.js": [
      "main.js",
      "app.module.js",
      "pipes/unescapeHtml.pipe.js",
      "campaign/campaign.component.js",
      "calendar/calendar.service.js",
      "calendar/calendar.component.js",
      "app-student-services/search.js",
      "app-student-services/search/service.js",
      "app-student-services/search/service/search.service.js",
      "app-student-services/search/results.js",
      "app-student-services/search/results/results.component.js",
      "app-student-services/search/form.js",
      "app-student-services/search/form/form.component.js",
      "app-student-services/search/filter.js",
      "app-student-services/search/filter/filter.component.js",
      "app-student-services/app-student-services.component.js"
    ],
    "bundle-dependencies.js": [
      "npm:rxjs@5.0.0-beta.12/add/operator/do.js",
      "npm:rxjs@5.0.0-beta.12/operator/do.js",
      "npm:rxjs@5.0.0-beta.12/Subscriber.js",
      "npm:rxjs@5.0.0-beta.12/symbol/rxSubscriber.js",
      "npm:rxjs@5.0.0-beta.12/util/root.js",
      "npm:rxjs@5.0.0-beta.12/Observer.js",
      "npm:rxjs@5.0.0-beta.12/Subscription.js",
      "github:jspm/nodelibs-process@0.1.2.js",
      "github:jspm/nodelibs-process@0.1.2/index.js",
      "npm:process@0.11.9.js",
      "npm:process@0.11.9/browser.js",
      "npm:rxjs@5.0.0-beta.12/util/UnsubscriptionError.js",
      "npm:rxjs@5.0.0-beta.12/util/errorObject.js",
      "npm:rxjs@5.0.0-beta.12/util/tryCatch.js",
      "npm:rxjs@5.0.0-beta.12/util/isFunction.js",
      "npm:rxjs@5.0.0-beta.12/util/isObject.js",
      "npm:rxjs@5.0.0-beta.12/util/isArray.js",
      "npm:rxjs@5.0.0-beta.12/Observable.js",
      "npm:rxjs@5.0.0-beta.12/symbol/observable.js",
      "npm:rxjs@5.0.0-beta.12/util/toSubscriber.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/distinctUntilChanged.js",
      "npm:rxjs@5.0.0-beta.12/operator/distinctUntilChanged.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/catch.js",
      "npm:rxjs@5.0.0-beta.12/operator/catch.js",
      "npm:rxjs@5.0.0-beta.12/util/subscribeToResult.js",
      "npm:rxjs@5.0.0-beta.12/InnerSubscriber.js",
      "npm:rxjs@5.0.0-beta.12/symbol/iterator.js",
      "npm:rxjs@5.0.0-beta.12/util/isPromise.js",
      "npm:rxjs@5.0.0-beta.12/OuterSubscriber.js",
      "npm:rxjs@5.0.0-beta.12/add/observable/fromEvent.js",
      "npm:rxjs@5.0.0-beta.12/observable/fromEvent.js",
      "npm:rxjs@5.0.0-beta.12/observable/FromEventObservable.js",
      "npm:ng2-bootstrap@1.1.4/ng2-bootstrap.js",
      "npm:ng2-bootstrap@1.1.4/components/index.js",
      "npm:ng2-bootstrap@1.1.4/components/utils/components-helper.service.js",
      "npm:@angular/platform-browser@2.1.0//bundles/platform-browser.umd.js",
      "npm:@angular/core@2.1.0//bundles/core.umd.js",
      "npm:rxjs@5.0.0-beta.12/Subject.js",
      "npm:rxjs@5.0.0-beta.12/SubjectSubscription.js",
      "npm:rxjs@5.0.0-beta.12/util/ObjectUnsubscribedError.js",
      "npm:@angular/common@2.1.0//bundles/common.umd.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead.module.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead.directive.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/toArray.js",
      "npm:rxjs@5.0.0-beta.12/operator/toArray.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/mergeMap.js",
      "npm:rxjs@5.0.0-beta.12/operator/mergeMap.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/map.js",
      "npm:rxjs@5.0.0-beta.12/operator/map.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/filter.js",
      "npm:rxjs@5.0.0-beta.12/operator/filter.js",
      "npm:rxjs@5.0.0-beta.12/add/operator/debounceTime.js",
      "npm:rxjs@5.0.0-beta.12/operator/debounceTime.js",
      "npm:rxjs@5.0.0-beta.12/scheduler/async.js",
      "npm:rxjs@5.0.0-beta.12/scheduler/AsyncScheduler.js",
      "npm:rxjs@5.0.0-beta.12/Scheduler.js",
      "npm:rxjs@5.0.0-beta.12/scheduler/AsyncAction.js",
      "npm:rxjs@5.0.0-beta.12/scheduler/Action.js",
      "npm:rxjs@5.0.0-beta.12/add/observable/from.js",
      "npm:rxjs@5.0.0-beta.12/observable/from.js",
      "npm:rxjs@5.0.0-beta.12/observable/FromObservable.js",
      "npm:rxjs@5.0.0-beta.12/operator/observeOn.js",
      "npm:rxjs@5.0.0-beta.12/Notification.js",
      "npm:rxjs@5.0.0-beta.12/observable/ArrayLikeObservable.js",
      "npm:rxjs@5.0.0-beta.12/observable/EmptyObservable.js",
      "npm:rxjs@5.0.0-beta.12/observable/ScalarObservable.js",
      "npm:rxjs@5.0.0-beta.12/observable/ArrayObservable.js",
      "npm:rxjs@5.0.0-beta.12/util/isScheduler.js",
      "npm:rxjs@5.0.0-beta.12/observable/IteratorObservable.js",
      "npm:rxjs@5.0.0-beta.12/observable/PromiseObservable.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead-utils.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/latin-map.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead-options.class.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead-container.component.js",
      "npm:ng2-bootstrap@1.1.4/components/position.js",
      "npm:ng2-bootstrap@1.1.4/components/ng2-bootstrap-config.js",
      "npm:ng2-bootstrap@1.1.4/components/utils/facade/browser.js",
      "npm:@angular/forms@2.1.0//bundles/forms.umd.js",
      "npm:rxjs@5.0.0-beta.12/observable/fromPromise.js",
      "npm:rxjs@5.0.0-beta.12/operator/toPromise.js",
      "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip.module.js",
      "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip-options.class.js",
      "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip-container.component.js",
      "npm:ng2-bootstrap@1.1.4/components/timepicker/timepicker.module.js",
      "npm:ng2-bootstrap@1.1.4/components/timepicker/timepicker.component.js",
      "npm:ng2-bootstrap@1.1.4/components/tabs/tabs.module.js",
      "npm:ng2-bootstrap@1.1.4/components/tabs/tabset.component.js",
      "npm:ng2-bootstrap@1.1.4/components/tabs/tab.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/tabs/tab-heading.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/common.js",
      "npm:ng2-bootstrap@1.1.4/components/rating/rating.module.js",
      "npm:ng2-bootstrap@1.1.4/components/rating/rating.component.js",
      "npm:ng2-bootstrap@1.1.4/components/progressbar/progressbar.module.js",
      "npm:ng2-bootstrap@1.1.4/components/progressbar/progressbar.component.js",
      "npm:ng2-bootstrap@1.1.4/components/progressbar/progress.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/progressbar/bar.component.js",
      "npm:ng2-bootstrap@1.1.4/components/pagination/pagination.module.js",
      "npm:ng2-bootstrap@1.1.4/components/pagination/pagination.component.js",
      "npm:ng2-bootstrap@1.1.4/components/pagination/pager.component.js",
      "npm:ng2-bootstrap@1.1.4/components/modal/modal.module.js",
      "npm:ng2-bootstrap@1.1.4/components/modal/modal.component.js",
      "npm:ng2-bootstrap@1.1.4/components/modal/modal-options.class.js",
      "npm:ng2-bootstrap@1.1.4/components/modal/modal-backdrop.component.js",
      "npm:ng2-bootstrap@1.1.4/components/utils/utils.class.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown.module.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown.service.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown-toggle.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown-menu.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker.module.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/yearpicker.component.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker-inner.component.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/date-formatter.js",
      "npm:moment@2.15.1/moment.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/monthpicker.component.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/daypicker.component.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker.component.js",
      "npm:ng2-bootstrap@1.1.4/components/collapse/collapse.module.js",
      "npm:ng2-bootstrap@1.1.4/components/collapse/collapse.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/carousel/carousel.module.js",
      "npm:ng2-bootstrap@1.1.4/components/carousel/slide.component.js",
      "npm:ng2-bootstrap@1.1.4/components/carousel/carousel.component.js",
      "npm:ng2-bootstrap@1.1.4/components/buttons/buttons.module.js",
      "npm:ng2-bootstrap@1.1.4/components/buttons/button-radio.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/buttons/button-checkbox.directive.js",
      "npm:ng2-bootstrap@1.1.4/components/alert/alert.module.js",
      "npm:ng2-bootstrap@1.1.4/components/alert/alert.component.js",
      "npm:ng2-bootstrap@1.1.4/components/accordion/accordion.module.js",
      "npm:ng2-bootstrap@1.1.4/components/accordion/accordion.component.js",
      "npm:ng2-bootstrap@1.1.4/components/accordion/accordion-group.component.js",
      "npm:ng2-bootstrap@1.1.4/components/typeahead.js",
      "npm:ng2-bootstrap@1.1.4/components/tooltip.js",
      "npm:ng2-bootstrap@1.1.4/components/timepicker.js",
      "npm:ng2-bootstrap@1.1.4/components/tabs.js",
      "npm:ng2-bootstrap@1.1.4/components/rating.js",
      "npm:ng2-bootstrap@1.1.4/components/progressbar.js",
      "npm:ng2-bootstrap@1.1.4/components/pagination.js",
      "npm:ng2-bootstrap@1.1.4/components/dropdown.js",
      "npm:ng2-bootstrap@1.1.4/components/modal.js",
      "npm:ng2-bootstrap@1.1.4/components/datepicker.js",
      "npm:ng2-bootstrap@1.1.4/components/collapse.js",
      "npm:ng2-bootstrap@1.1.4/components/carousel.js",
      "npm:ng2-bootstrap@1.1.4/components/buttons.js",
      "npm:ng2-bootstrap@1.1.4/components/alert.js",
      "npm:ng2-bootstrap@1.1.4/components/accordion.js",
      "npm:@angular/platform-browser-dynamic@2.1.0//bundles/platform-browser-dynamic.umd.js",
      "npm:@angular/compiler@2.1.0//bundles/compiler.umd.js",
      "npm:@angular/http@2.1.0//bundles/http.umd.js"
    ]
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
      "main": "moment.js"
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
    "@angular": "npm:@angular",
    "@angular/common": "npm:@angular/common@2.1.0",
    "@angular/compiler": "npm:@angular/compiler@2.1.0",
    "@angular/core": "npm:@angular/core@2.1.0",
    "@angular/forms": "npm:@angular/forms@2.1.0",
    "@angular/http": "npm:@angular/http@2.1.0",
    "@angular/platform-browser": "npm:@angular/platform-browser@2.1.0",
    "@angular/platform-browser-dynamic": "npm:@angular/platform-browser-dynamic@2.1.0",
    "@angular/router": "npm:@angular/router",
    "@angular/upgrade": "npm:@angular/upgrade@2.1.0",
    "angular/angular": "github:angular/angular@2.1.0",
    "app": "",
    "babel": "npm:babel-core@5.8.38",
    "babel-runtime": "npm:babel-runtime@5.8.38",
    "core-js": "npm:core-js@2.4.0",
    "main": "",
    "moment": "npm:moment@2.15.1",
    "ng2-bootstrap": "npm:ng2-bootstrap@1.1.14",
    "reflect-metadata": "npm:reflect-metadata@0.1.3",
    "rxjs": "npm:rxjs@5.0.0-beta.12",
    "zone.js": "npm:zone.js@0.6.21",
    "process": "npm:process@0.11.9",
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
    "npm:@angular/common@2.1.0": {
      "@angular/core": "npm:@angular/core@2.1.0"
    },
    "npm:@angular/compiler@2.1.0": {
      "@angular/core": "npm:@angular/core@2.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/core@2.1.0": {
      "process": "github:jspm/nodelibs-process@0.1.2",
      "rxjs": "npm:rxjs@5.0.0-beta.12",
      "zone.js": "npm:zone.js@0.6.21"
    },
    "npm:@angular/forms@2.1.0": {
      "@angular/common": "npm:@angular/common@2.1.0",
      "@angular/core": "npm:@angular/core@2.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/http@2.1.0": {
      "@angular/core": "npm:@angular/core@2.1.0",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.1.0",
      "rxjs": "npm:rxjs@5.0.0-beta.12"
    },
    "npm:@angular/platform-browser-dynamic@2.1.0": {
      "@angular/common": "npm:@angular/common@2.1.0",
      "@angular/compiler": "npm:@angular/compiler@2.1.0",
      "@angular/core": "npm:@angular/core@2.1.0",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.1.0"
    },
    "npm:@angular/platform-browser@2.1.0": {
      "@angular/common": "npm:@angular/common@2.1.0",
      "@angular/core": "npm:@angular/core@2.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:@angular/upgrade@2.1.0": {
      "@angular/compiler": "npm:@angular/compiler@2.1.0",
      "@angular/core": "npm:@angular/core@2.1.0",
      "@angular/platform-browser": "npm:@angular/platform-browser@2.1.0",
      "@angular/platform-browser-dynamic": "npm:@angular/platform-browser-dynamic@2.1.0"
    },
    "npm:asn1.js@4.8.0": {
      "assert": "github:jspm/nodelibs-assert@0.1.0",
      "bn.js": "npm:bn.js@4.11.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "fs": "github:jspm/nodelibs-fs@0.1.2",
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
      "ieee754": "npm:ieee754@1.1.6",
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
    "npm:core-js@2.4.0": {
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
      "sha.js": "npm:sha.js@2.4.5"
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
      "pbkdf2": "npm:pbkdf2@3.0.6",
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
    "npm:inherits@2.0.1": {
      "util": "github:jspm/nodelibs-util@0.1.0"
    },
    "npm:miller-rabin@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "brorand": "npm:brorand@1.0.6"
    },
    "npm:ng2-bootstrap@1.1.14": {
      "@angular/common": "npm:@angular/common@2.1.0",
      "@angular/compiler": "npm:@angular/compiler@2.1.0",
      "@angular/core": "npm:@angular/core@2.1.0",
      "@angular/forms": "npm:@angular/forms@2.1.0",
      "moment": "npm:moment@2.15.1"
    },
    "npm:parse-asn1@5.0.0": {
      "asn1.js": "npm:asn1.js@4.8.0",
      "browserify-aes": "npm:browserify-aes@1.0.6",
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "create-hash": "npm:create-hash@1.1.2",
      "evp_bytestokey": "npm:evp_bytestokey@1.0.0",
      "pbkdf2": "npm:pbkdf2@3.0.6",
      "systemjs-json": "github:systemjs/plugin-json@0.1.2"
    },
    "npm:path-browserify@0.0.0": {
      "process": "github:jspm/nodelibs-process@0.1.2"
    },
    "npm:pbkdf2@3.0.6": {
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
    "npm:rxjs@5.0.0-beta.12": {
      "buffer": "github:jspm/nodelibs-buffer@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "symbol-observable": "npm:symbol-observable@1.0.2"
    },
    "npm:sha.js@2.4.5": {
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
    "npm:zone.js@0.6.21": {
      "crypto": "github:jspm/nodelibs-crypto@0.1.0",
      "process": "github:jspm/nodelibs-process@0.1.2",
      "timers": "github:jspm/nodelibs-timers@0.1.0"
    }
  }
};
