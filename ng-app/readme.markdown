Angular search app for UCF student services.

# Environment:
[JSPM](http://jspm.io/) - manage package dependencies
  (a "Registry and format agnostic JavaScript package manager.")
[SystemJS](https://github.com/systemjs/systemjs) - load dependencies (the "Universal dynamic module loader")
[TypeScript](https://www.typescriptlang.org/) - transpile to javascript, leverage new language features.
  [Typings](https://github.com/typings/typings) - typescript intellisense and strong typing
    for external modules (definition files).
[SCSS](http://sass-lang.com/) - styling transpile to css, handled by top-level project.
[Angular v2.1+](https://angular.io/) - front-end framework.
  Requires: Zone.js, Reflect-Metadata, [RxJS v5+](https://github.com/ReactiveX/rxjs/),
    a module loader (e.g., SystemJS, Webpack)
  Polyfills for older browsers:
  	See https://angular.io/docs/ts/latest/guide/browser-support.html
  	ES6 (core-js) - https://github.com/zloirock/core-js
	classList - https://github.com/eligrey/classList.js
	Intl - https://github.com/andyearnshaw/Intl.js
	Web Animations - https://github.com/web-animations/web-animations-js
	Typed Array - https://github.com/inexorabletash/polyfill/blob/master/typedarray.js
	Blob - https://github.com/eligrey/Blob.js
	FormData - https://github.com/francois2metz/html5-formdata

# Libraries:
[ng2-bootstrap](https://github.com/valor-software/ng2-bootstrap) (for [typeahead directives](http://valor-software.com/ng2-bootstrap/#/typeahead)).
[moment.js](http://www.momentjs.com/) - datetime library, used for formatting (also a dependency of ng2-bootstrap).
[jQuery](http://jquery.com/) - Utility functions, including HTML document traversal and manipulation, event handling, animation, and Ajax.

# Angular 2:
## Components:
<ucf-app-student-services>
<ucf-search-form>
<ucf-search-filter>
<ucf-search-results>
<ucf-campaign>
<ucf-calendar>
templates - using [lodash templates](https://lodash.com/docs#template) to both generate PHP and Angular2 template files.

## Services:
SearchService
CalendarService

## Interfaces:
IStudentServiceSummary
IStudentService
ICampaignModel
ICalendarEvent

## Pipes (analog to Angular1 filters):
UnescapeHtmlPipe (deprecated) - use @angular/platform-browser/DomSanitzer instead.
