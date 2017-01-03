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
      "ng2-bootstrap/ng2-bootstrap",
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
    "npm:ng2-bootstrap@1.1.4/ng2-bootstrap.js": [
      "./components/accordion",
      "./components/alert",
      "./components/buttons",
      "./components/carousel",
      "./components/collapse",
      "./components/datepicker",
      "./components/modal",
      "./components/dropdown",
      "./components/pagination",
      "./components/progressbar",
      "./components/rating",
      "./components/tabs",
      "./components/timepicker",
      "./components/tooltip",
      "./components/typeahead",
      "./components/position",
      "./components/common",
      "./components/ng2-bootstrap-config",
      "./components/accordion/accordion.module",
      "./components/alert/alert.module",
      "./components/buttons/buttons.module",
      "./components/carousel/carousel.module",
      "./components/collapse/collapse.module",
      "./components/datepicker/datepicker.module",
      "./components/dropdown/dropdown.module",
      "./components/modal/modal.module",
      "./components/pagination/pagination.module",
      "./components/progressbar/progressbar.module",
      "./components/rating/rating.module",
      "./components/tabs/tabs.module",
      "./components/timepicker/timepicker.module",
      "./components/tooltip/tooltip.module",
      "./components/typeahead/typeahead.module",
      "./components/utils/components-helper.service",
      "./components/index"
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
    "npm:rxjs@5.0.0-beta.12/Subject.js": [
      "./Observable",
      "./Subscriber",
      "./Subscription",
      "./util/ObjectUnsubscribedError",
      "./SubjectSubscription",
      "./symbol/rxSubscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/Observable.js": [
      "./util/root",
      "./util/toSubscriber",
      "./symbol/observable"
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
    "npm:rxjs@5.0.0-beta.12/add/operator/catch.js": [
      "../../Observable",
      "../../operator/catch"
    ],
    "npm:ng2-bootstrap@1.1.4/components/accordion.js": [
      "./accordion/accordion-group.component",
      "./accordion/accordion.component",
      "./accordion/accordion.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/alert.js": [
      "./alert/alert.component",
      "./alert/alert.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/buttons.js": [
      "./buttons/button-checkbox.directive",
      "./buttons/button-radio.directive",
      "./buttons/buttons.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/carousel.js": [
      "./carousel/carousel.component",
      "./carousel/carousel.module",
      "./carousel/slide.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker.js": [
      "./datepicker/datepicker.component",
      "./datepicker/datepicker.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/collapse.js": [
      "./collapse/collapse.directive",
      "./collapse/collapse.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/modal.js": [
      "./modal/modal-backdrop.component",
      "./modal/modal-options.class",
      "./modal/modal.component",
      "./modal/modal.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/dropdown.js": [
      "./dropdown/dropdown-menu.directive",
      "./dropdown/dropdown-toggle.directive",
      "./dropdown/dropdown.directive",
      "./dropdown/dropdown.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/progressbar.js": [
      "./progressbar/bar.component",
      "./progressbar/progress.directive",
      "./progressbar/progressbar.component",
      "./progressbar/progressbar.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/pagination.js": [
      "./pagination/pager.component",
      "./pagination/pagination.component",
      "./pagination/pagination.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/rating.js": [
      "./rating/rating.component",
      "./rating/rating.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tabs.js": [
      "./tabs/tab-heading.directive",
      "./tabs/tabset.component",
      "./tabs/tab.directive",
      "./tabs/tabs.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/timepicker.js": [
      "./timepicker/timepicker.component",
      "./timepicker/timepicker.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/typeahead.js": [
      "./typeahead/typeahead-container.component",
      "./typeahead/typeahead-options.class",
      "./typeahead/typeahead.directive",
      "./typeahead/typeahead.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tooltip.js": [
      "./tooltip/tooltip-container.component",
      "./tooltip/tooltip.directive",
      "./tooltip/tooltip.module"
    ],
    "npm:ng2-bootstrap@1.1.4/components/ng2-bootstrap-config.js": [
      "./utils/facade/browser"
    ],
    "npm:ng2-bootstrap@1.1.4/components/common.js": [
      "@angular/core"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/toPromise.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/fromPromise.js": [
      "./PromiseObservable"
    ],
    "npm:rxjs@5.0.0-beta.12/Subscriber.js": [
      "./util/isFunction",
      "./Subscription",
      "./Observer",
      "./symbol/rxSubscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/SubjectSubscription.js": [
      "./Subscription"
    ],
    "npm:rxjs@5.0.0-beta.12/Subscription.js": [
      "./util/isArray",
      "./util/isObject",
      "./util/isFunction",
      "./util/tryCatch",
      "./util/errorObject",
      "./util/UnsubscriptionError",
      "process"
    ],
    "npm:ng2-bootstrap@1.1.4/components/accordion/accordion.module.js": [
      "@angular/common",
      "@angular/core",
      "../collapse/collapse.module",
      "./accordion-group.component",
      "./accordion.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/buttons/buttons.module.js": [
      "@angular/core",
      "@angular/forms",
      "./button-checkbox.directive",
      "./button-radio.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/alert/alert.module.js": [
      "@angular/common",
      "@angular/core",
      "./alert.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./datepicker-inner.component",
      "./datepicker.component",
      "./daypicker.component",
      "./monthpicker.component",
      "./yearpicker.component",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/collapse/collapse.module.js": [
      "@angular/core",
      "./collapse.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/carousel/carousel.module.js": [
      "@angular/common",
      "@angular/core",
      "./carousel.component",
      "./slide.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown.module.js": [
      "@angular/core",
      "./dropdown-menu.directive",
      "./dropdown-toggle.directive",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/modal/modal.module.js": [
      "@angular/core",
      "./modal-backdrop.component",
      "./modal.component",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/pagination/pagination.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./pager.component",
      "./pagination.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/progressbar/progressbar.module.js": [
      "@angular/common",
      "@angular/core",
      "./bar.component",
      "./progress.directive",
      "./progressbar.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/rating/rating.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./rating.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tabs/tabs.module.js": [
      "@angular/common",
      "@angular/core",
      "../common",
      "./tab-heading.directive",
      "./tab.directive",
      "./tabset.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/timepicker/timepicker.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./timepicker.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/index.js": [
      "@angular/core",
      "./accordion/accordion.module",
      "./alert/alert.module",
      "./buttons/buttons.module",
      "./carousel/carousel.module",
      "./collapse/collapse.module",
      "./datepicker/datepicker.module",
      "./dropdown/dropdown.module",
      "./modal/modal.module",
      "./pagination/pagination.module",
      "./progressbar/progressbar.module",
      "./rating/rating.module",
      "./tabs/tabs.module",
      "./timepicker/timepicker.module",
      "./tooltip/tooltip.module",
      "./typeahead/typeahead.module",
      "./utils/components-helper.service"
    ],
    "npm:@angular/common@2.1.0//bundles/common.umd.js": [
      "@angular/core"
    ],
    "npm:rxjs@5.0.0-beta.12/symbol/rxSubscriber.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.0-beta.12/util/toSubscriber.js": [
      "../Subscriber",
      "../symbol/rxSubscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/symbol/observable.js": [
      "../util/root"
    ],
    "github:jspm/nodelibs-process@0.1.2/index.js": [
      "process"
    ],
    "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./typeahead-container.component",
      "./typeahead.directive",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/utils/components-helper.service.js": [
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip.module.js": [
      "@angular/common",
      "@angular/core",
      "./tooltip-container.component",
      "./tooltip.directive",
      "../utils/components-helper.service"
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
    "npm:rxjs@5.0.0-beta.12/operator/catch.js": [
      "../OuterSubscriber",
      "../util/subscribeToResult"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/PromiseObservable.js": [
      "../util/root",
      "../Observable"
    ],
    "npm:rxjs@5.0.0-beta.12/util/tryCatch.js": [
      "./errorObject"
    ],
    "npm:ng2-bootstrap@1.1.4/components/buttons/button-checkbox.directive.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/buttons/button-radio.directive.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/alert/alert.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/accordion/accordion-group.component.js": [
      "@angular/core",
      "./accordion.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/carousel/carousel.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config"
    ],
    "npm:ng2-bootstrap@1.1.4/components/collapse/collapse.directive.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/accordion/accordion.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/carousel/slide.component.js": [
      "@angular/core",
      "./carousel.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown-menu.directive.js": [
      "@angular/core",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown-toggle.directive.js": [
      "@angular/core",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/dropdown/dropdown.directive.js": [
      "@angular/core",
      "./dropdown.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/modal/modal-backdrop.component.js": [
      "@angular/core",
      "./modal-options.class"
    ],
    "npm:ng2-bootstrap@1.1.4/components/progressbar/progress.directive.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/progressbar/progressbar.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/progressbar/bar.component.js": [
      "@angular/core",
      "./progress.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/modal/modal.component.js": [
      "@angular/core",
      "../utils/components-helper.service",
      "../utils/utils.class",
      "./modal-backdrop.component",
      "./modal-options.class",
      "../utils/facade/browser"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tabs/tab-heading.directive.js": [
      "@angular/core",
      "./tab.directive"
    ],
    "npm:ng2-bootstrap@1.1.4/components/pagination/pager.component.js": [
      "@angular/core",
      "@angular/forms",
      "./pagination.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tabs/tab.directive.js": [
      "@angular/core",
      "./tabset.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/pagination/pagination.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/rating/rating.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead.directive.js": [
      "@angular/core",
      "@angular/forms",
      "./typeahead-container.component",
      "./typeahead-options.class",
      "./typeahead-utils",
      "rxjs/Observable",
      "rxjs/add/observable/from",
      "rxjs/add/operator/debounceTime",
      "rxjs/add/operator/filter",
      "rxjs/add/operator/map",
      "rxjs/add/operator/mergeMap",
      "rxjs/add/operator/toArray",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tabs/tabset.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip.directive.js": [
      "@angular/core",
      "./tooltip-container.component",
      "./tooltip-options.class",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.4/components/timepicker/timepicker.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead-container.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "../position",
      "./typeahead-options.class",
      "./typeahead-utils"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip-container.component.js": [
      "@angular/core",
      "../position",
      "./tooltip-options.class"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/daypicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:process@0.11.9.js": [
      "npm:process@0.11.9/browser.js"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/monthpicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/yearpicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/datepicker-inner.component.js": [
      "@angular/core",
      "./date-formatter"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/map.js": [
      "../../Observable",
      "../../operator/map"
    ],
    "npm:rxjs@5.0.0-beta.12/add/observable/fromEvent.js": [
      "../../Observable",
      "../../observable/fromEvent"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/do.js": [
      "../../Observable",
      "../../operator/do"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/debounceTime.js": [
      "../../Observable",
      "../../operator/debounceTime"
    ],
    "npm:rxjs@5.0.0-beta.12/OuterSubscriber.js": [
      "./Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/distinctUntilChanged.js": [
      "../../Observable",
      "../../operator/distinctUntilChanged"
    ],
    "npm:rxjs@5.0.0-beta.12/add/observable/from.js": [
      "../../Observable",
      "../../observable/from"
    ],
    "npm:rxjs@5.0.0-beta.12/util/subscribeToResult.js": [
      "./root",
      "./isArray",
      "./isPromise",
      "../Observable",
      "../symbol/iterator",
      "../InnerSubscriber",
      "../symbol/observable"
    ],
    "npm:ng2-bootstrap@1.1.4/components/utils/utils.class.js": [
      "./facade/browser"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/mergeMap.js": [
      "../../Observable",
      "../../operator/mergeMap"
    ],
    "npm:ng2-bootstrap@1.1.4/components/typeahead/typeahead-utils.js": [
      "./latin-map"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/filter.js": [
      "../../Observable",
      "../../operator/filter"
    ],
    "npm:ng2-bootstrap@1.1.4/components/tooltip/tooltip-options.class.js": [
      "@angular/core"
    ],
    "npm:rxjs@5.0.0-beta.12/add/operator/toArray.js": [
      "../../Observable",
      "../../operator/toArray"
    ],
    "npm:ng2-bootstrap@1.1.4/components/datepicker/date-formatter.js": [
      "moment"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/map.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/fromEvent.js": [
      "./FromEventObservable"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/do.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/distinctUntilChanged.js": [
      "../Subscriber",
      "../util/tryCatch",
      "../util/errorObject"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/debounceTime.js": [
      "../Subscriber",
      "../scheduler/async"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/from.js": [
      "./FromObservable"
    ],
    "npm:rxjs@5.0.0-beta.12/symbol/iterator.js": [
      "../util/root"
    ],
    "npm:rxjs@5.0.0-beta.12/InnerSubscriber.js": [
      "./Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/mergeMap.js": [
      "../util/subscribeToResult",
      "../OuterSubscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/filter.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/toArray.js": [
      "../Subscriber"
    ],
    "npm:rxjs@5.0.0-beta.12/scheduler/async.js": [
      "./AsyncAction",
      "./AsyncScheduler"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/FromObservable.js": [
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
    "npm:rxjs@5.0.0-beta.12/observable/FromEventObservable.js": [
      "../Observable",
      "../util/tryCatch",
      "../util/isFunction",
      "../util/errorObject",
      "../Subscription",
      "process"
    ],
    "npm:rxjs@5.0.0-beta.12/scheduler/AsyncAction.js": [
      "../util/root",
      "./Action"
    ],
    "npm:rxjs@5.0.0-beta.12/scheduler/AsyncScheduler.js": [
      "../Scheduler"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/IteratorObservable.js": [
      "../util/root",
      "../Observable",
      "../symbol/iterator"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/ArrayLikeObservable.js": [
      "../Observable",
      "./ScalarObservable",
      "./EmptyObservable"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/ArrayObservable.js": [
      "../Observable",
      "./ScalarObservable",
      "./EmptyObservable",
      "../util/isScheduler"
    ],
    "npm:rxjs@5.0.0-beta.12/operator/observeOn.js": [
      "../Subscriber",
      "../Notification"
    ],
    "npm:rxjs@5.0.0-beta.12/Scheduler.js": [
      "process"
    ],
    "npm:rxjs@5.0.0-beta.12/scheduler/Action.js": [
      "../Subscription"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/ScalarObservable.js": [
      "../Observable"
    ],
    "npm:rxjs@5.0.0-beta.12/observable/EmptyObservable.js": [
      "../Observable"
    ],
    "npm:rxjs@5.0.0-beta.12/Notification.js": [
      "./Observable"
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
    "npm:ng2-bootstrap@1.1.14/ng2-bootstrap.js": [
      "./components/accordion",
      "./components/alert",
      "./components/buttons",
      "./components/carousel",
      "./components/collapse",
      "./components/datepicker",
      "./components/modal",
      "./components/dropdown",
      "./components/pagination",
      "./components/progressbar",
      "./components/rating",
      "./components/tabs",
      "./components/timepicker",
      "./components/tooltip",
      "./components/typeahead",
      "./components/position",
      "./components/common",
      "./components/ng2-bootstrap-config",
      "./components/accordion/accordion.module",
      "./components/alert/alert.module",
      "./components/buttons/buttons.module",
      "./components/carousel/carousel.module",
      "./components/collapse/collapse.module",
      "./components/datepicker/datepicker.module",
      "./components/dropdown/dropdown.module",
      "./components/modal/modal.module",
      "./components/pagination/pagination.module",
      "./components/progressbar/progressbar.module",
      "./components/rating/rating.module",
      "./components/tabs/tabs.module",
      "./components/timepicker/timepicker.module",
      "./components/tooltip/tooltip.module",
      "./components/typeahead/typeahead.module",
      "./components/utils/components-helper.service",
      "./components/index"
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
    "npm:ng2-bootstrap@1.1.14/components/accordion.js": [
      "./accordion/accordion-group.component",
      "./accordion/accordion.component",
      "./accordion/accordion.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/alert.js": [
      "./alert/alert.component",
      "./alert/alert.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/buttons.js": [
      "./buttons/button-checkbox.directive",
      "./buttons/button-radio.directive",
      "./buttons/buttons.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker.js": [
      "./datepicker/datepicker.component",
      "./datepicker/datepicker.module",
      "./datepicker/daypicker.component",
      "./datepicker/monthpicker.component",
      "./datepicker/yearpicker.component",
      "./datepicker/date-formatter"
    ],
    "npm:ng2-bootstrap@1.1.14/components/collapse.js": [
      "./collapse/collapse.directive",
      "./collapse/collapse.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/modal.js": [
      "./modal/modal-backdrop.component",
      "./modal/modal-options.class",
      "./modal/modal.component",
      "./modal/modal.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/dropdown.js": [
      "./dropdown/dropdown-menu.directive",
      "./dropdown/dropdown-toggle.directive",
      "./dropdown/dropdown.directive",
      "./dropdown/dropdown.service",
      "./dropdown/dropdown.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/carousel.js": [
      "./carousel/carousel.component",
      "./carousel/carousel.module",
      "./carousel/slide.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/pagination.js": [
      "./pagination/pager.component",
      "./pagination/pagination.component",
      "./pagination/pagination.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/rating.js": [
      "./rating/rating.component",
      "./rating/rating.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/timepicker.js": [
      "./timepicker/timepicker.component",
      "./timepicker/timepicker.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/progressbar.js": [
      "./progressbar/bar.component",
      "./progressbar/progress.directive",
      "./progressbar/progressbar.component",
      "./progressbar/progressbar.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tabs.js": [
      "./tabs/tab-heading.directive",
      "./tabs/tabset.component",
      "./tabs/tab.directive",
      "./tabs/tabs.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/typeahead.js": [
      "./typeahead/typeahead-match.class",
      "./typeahead/typeahead-options.class",
      "./typeahead/typeahead-utils",
      "./typeahead/typeahead-container.component",
      "./typeahead/typeahead.directive",
      "./typeahead/typeahead.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tooltip.js": [
      "./tooltip/tooltip-container.component",
      "./tooltip/tooltip.directive",
      "./tooltip/tooltip.module"
    ],
    "npm:ng2-bootstrap@1.1.14/components/ng2-bootstrap-config.js": [
      "./utils/facade/browser"
    ],
    "npm:ng2-bootstrap@1.1.14/components/common.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/accordion/accordion.module.js": [
      "@angular/common",
      "@angular/core",
      "../collapse/collapse.module",
      "./accordion-group.component",
      "./accordion.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/buttons/buttons.module.js": [
      "@angular/core",
      "@angular/forms",
      "./button-checkbox.directive",
      "./button-radio.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/alert/alert.module.js": [
      "@angular/common",
      "@angular/core",
      "./alert.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/carousel/carousel.module.js": [
      "@angular/common",
      "@angular/core",
      "./carousel.component",
      "./slide.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/datepicker.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./datepicker-inner.component",
      "./datepicker.component",
      "./daypicker.component",
      "./monthpicker.component",
      "./yearpicker.component",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/collapse/collapse.module.js": [
      "@angular/core",
      "./collapse.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/modal/modal.module.js": [
      "@angular/core",
      "./modal-backdrop.component",
      "./modal.component",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/dropdown/dropdown.module.js": [
      "@angular/core",
      "./dropdown-menu.directive",
      "./dropdown-toggle.directive",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/pagination/pagination.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./pager.component",
      "./pagination.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/progressbar/progressbar.module.js": [
      "@angular/common",
      "@angular/core",
      "./bar.component",
      "./progress.directive",
      "./progressbar.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/rating/rating.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./rating.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tabs/tabs.module.js": [
      "@angular/common",
      "@angular/core",
      "../common",
      "./tab-heading.directive",
      "./tab.directive",
      "./tabset.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/timepicker/timepicker.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./timepicker.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/utils/components-helper.service.js": [
      "@angular/core",
      "@angular/platform-browser"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tooltip/tooltip.module.js": [
      "@angular/common",
      "@angular/core",
      "./tooltip-container.component",
      "./tooltip.directive",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/typeahead/typeahead.module.js": [
      "@angular/common",
      "@angular/core",
      "@angular/forms",
      "./typeahead-container.component",
      "./typeahead.directive",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/index.js": [
      "@angular/core",
      "./accordion/accordion.module",
      "./alert/alert.module",
      "./buttons/buttons.module",
      "./carousel/carousel.module",
      "./collapse/collapse.module",
      "./datepicker/datepicker.module",
      "./dropdown/dropdown.module",
      "./modal/modal.module",
      "./pagination/pagination.module",
      "./progressbar/progressbar.module",
      "./rating/rating.module",
      "./tabs/tabs.module",
      "./timepicker/timepicker.module",
      "./tooltip/tooltip.module",
      "./typeahead/typeahead.module",
      "./utils/components-helper.service"
    ],
    "npm:@angular/common@2.2.4//bundles/common.umd.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/typeahead/typeahead-utils.js": [
      "./latin-map"
    ],
    "npm:ng2-bootstrap@1.1.14/components/accordion/accordion-group.component.js": [
      "@angular/core",
      "./accordion.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/buttons/button-checkbox.directive.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/alert/alert.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/accordion/accordion.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/yearpicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/buttons/button-radio.directive.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/datepicker.component.js": [
      "@angular/core",
      "./datepicker-inner.component",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/daypicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/monthpicker.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "./datepicker-inner.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/date-formatter.js": [
      "moment"
    ],
    "npm:ng2-bootstrap@1.1.14/components/collapse/collapse.directive.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/modal/modal-backdrop.component.js": [
      "@angular/core",
      "./modal-options.class"
    ],
    "npm:ng2-bootstrap@1.1.14/components/modal/modal.component.js": [
      "@angular/core",
      "../utils/components-helper.service",
      "../utils/utils.class",
      "./modal-backdrop.component",
      "./modal-options.class",
      "../utils/facade/browser"
    ],
    "npm:ng2-bootstrap@1.1.14/components/dropdown/dropdown-toggle.directive.js": [
      "@angular/core",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/dropdown/dropdown-menu.directive.js": [
      "@angular/core",
      "./dropdown.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/carousel/carousel.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config"
    ],
    "npm:ng2-bootstrap@1.1.14/components/dropdown/dropdown.directive.js": [
      "@angular/core",
      "./dropdown.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/carousel/slide.component.js": [
      "@angular/core",
      "./carousel.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/pagination/pager.component.js": [
      "@angular/core",
      "@angular/forms",
      "./pagination.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/pagination/pagination.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/rating/rating.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/progressbar/bar.component.js": [
      "@angular/core",
      "./progress.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/timepicker/timepicker.component.js": [
      "@angular/core",
      "@angular/forms"
    ],
    "npm:ng2-bootstrap@1.1.14/components/progressbar/progress.directive.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/progressbar/progressbar.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tabs/tabset.component.js": [
      "@angular/core"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tabs/tab-heading.directive.js": [
      "@angular/core",
      "./tab.directive"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tabs/tab.directive.js": [
      "@angular/core",
      "./tabset.component"
    ],
    "npm:ng2-bootstrap@1.1.14/components/typeahead/typeahead-container.component.js": [
      "@angular/core",
      "../ng2-bootstrap-config",
      "../position",
      "./typeahead-options.class",
      "./typeahead-utils"
    ],
    "npm:ng2-bootstrap@1.1.14/components/typeahead/typeahead.directive.js": [
      "@angular/core",
      "@angular/forms",
      "./typeahead-container.component",
      "./typeahead-options.class",
      "./typeahead-utils",
      "rxjs/Observable",
      "rxjs/add/observable/from",
      "rxjs/add/operator/debounceTime",
      "rxjs/add/operator/filter",
      "rxjs/add/operator/map",
      "rxjs/add/operator/mergeMap",
      "rxjs/add/operator/toArray",
      "../utils/components-helper.service",
      "./typeahead-match.class"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tooltip/tooltip-container.component.js": [
      "@angular/core",
      "../position",
      "./tooltip-options.class"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tooltip/tooltip.directive.js": [
      "@angular/core",
      "./tooltip-container.component",
      "./tooltip-options.class",
      "../utils/components-helper.service"
    ],
    "npm:ng2-bootstrap@1.1.14/components/datepicker/datepicker-inner.component.js": [
      "@angular/core",
      "./date-formatter"
    ],
    "npm:ng2-bootstrap@1.1.14/components/utils/utils.class.js": [
      "./facade/browser"
    ],
    "npm:ng2-bootstrap@1.1.14/components/tooltip/tooltip-options.class.js": [
      "@angular/core"
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
    "main": "",
    "moment": "npm:moment@2.15.1",
    "ng2-bootstrap": "npm:ng2-bootstrap@1.1.14",
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
    "npm:inherits@2.0.1": {
      "util": "github:jspm/nodelibs-util@0.1.0"
    },
    "npm:miller-rabin@4.0.0": {
      "bn.js": "npm:bn.js@4.11.6",
      "brorand": "npm:brorand@1.0.6"
    },
    "npm:ng2-bootstrap@1.1.14": {
      "@angular/common": "npm:@angular/common@2.4.1",
      "@angular/compiler": "npm:@angular/compiler@2.4.1",
      "@angular/core": "npm:@angular/core@2.4.1",
      "@angular/forms": "npm:@angular/forms@2.4.1",
      "moment": "npm:moment@2.15.1",
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
