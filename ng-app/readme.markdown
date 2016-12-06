Angular search app for UCF student services.

# Environment:
- [JSPM](http://jspm.io/) - manage package dependencies (a "Registry and format agnostic JavaScript package manager.")
- [SystemJS](https://github.com/systemjs/systemjs) - load dependencies (the "Universal dynamic module loader")
- [TypeScript](https://www.typescriptlang.org/) - transpile to javascript, leverage new language features.
    - [Typings](https://github.com/typings/typings) - typescript intellisense and strong typing for external modules (definition files).
- [SCSS](http://sass-lang.com/) - styling transpile to css, handled by top-level project.
- [Angular v2.1+](https://angular.io/) - front-end framework.
    - Requires: Zone.js, Reflect-Metadata, [RxJS v5+](https://github.com/ReactiveX/rxjs/), a module loader (e.g., SystemJS, Webpack)
    - Polyfills for older browsers:
        See https://angular.io/docs/ts/latest/guide/browser-support.html
        - ES6 (core-js) - https://github.com/zloirock/core-js
        - classList - https://github.com/eligrey/classList.js
        - Intl - https://github.com/andyearnshaw/Intl.js
        - Web Animations - https://github.com/web-animations/web-animations-js
        - Typed Array - https://github.com/inexorabletash/polyfill/blob/master/typedarray.js
        - Blob - https://github.com/eligrey/Blob.js
        - FormData - https://github.com/francois2metz/html5-formdata

# Libraries:
- [ng2-bootstrap](https://github.com/valor-software/ng2-bootstrap) (for [typeahead directives](http://valor-software.com/ng2-bootstrap/#/typeahead)).
- [moment.js](http://www.momentjs.com/) - datetime library, used for formatting (also a dependency of ng2-bootstrap).
- [jQuery](http://jquery.com/) - Utility functions, including HTML document traversal and manipulation, event handling, animation, and Ajax.

# Angular 2:
## Components:
- &lt;ucf-app-student-services&gt;
- &lt;ucf-search-form&gt;
- &lt;ucf-search-filter&gt;
- &lt;ucf-search-results&gt;
- &lt;ucf-campaign&gt;
- &lt;ucf-calendar&gt;

Templates - using [lodash templates](https://lodash.com/docs#template) to both generate PHP and Angular2 template files.

## Services:
- SearchService
- CalendarService

## Interfaces:
- IStudentServiceSummary
- IStudentService
- ICampaignModel
- ICalendarEvent

## Pipes (analog to Angular1 filters):
UnescapeHtmlPipe (deprecated) - use [@angular/platform-browser/DomSanitzer](https://angular.io/docs/ts/latest/api/platform-browser/index/DomSanitizer-class.html) instead.

# Updating Angular

## JSPM Browser Optimization

This application uses multiple levels of browser optimization:
- Content Delivery Network (CDN) - common libraries from a shared network that may already be cached by the user.
- Dependency Cache - pre-generated listing of depenencies from JSPM, used to reducing initial load time by pre-fetching libraries from the CDN.
- Bundles - JSPM-generated, local, minified javascript files containing the CDN libraries (bundle-dependencies.js) and the application logic (bundle-app.js).

## Angular Update Procedure

1) Make sure you have the desired @angular version listed in package.json.

2) Run `jspm update @angular` inside this directory.  This will update `config.js` file. (Optionally, run `npm update @angular` if your local tools expect files in the `node_modules` folder)

3) In your local WordPress install, check that `/wp-content/themes/ucf-services-theme/ng-app/main.html` still works properly.

4) Run `jspm depcache main` in this directory to update the dependency cache (generates the `depCache` section of `config.js` to be used in `config.cdn.js`).

5) Run `npm run-script bundle` to inject and minify the `bundle-app.js` and `bundle-dependencies.js` files (generates the `bundles` section of `config.js` to be used in `config.ucf_local.js`).

6) Manually update the files `config.cdn.js` and `config.ucf_local.js` to match the generated `config.js`. A diff tool such as [WinMerge](http://winmerge.org/) or [Meld](http://meldmerge.org/) may help here. Do not edit the "Paths" sections.
   - config.js - Generated SystemJS configuration file. Local testing with main.html, , loads libraries via Paths set to local `jspm_packages` folder.
   - config.cdn.js - Primary SystemJS configuration file, loads libraries via Paths set to content-delivery networks.
      - Do not copy the "bundles" section to this file.
   - config.ucf_local.js - Backup SystemJS configuration file, loads libraries from local bundles.
      - There is no need to copy the depCache section to this file).

## Browser Optimization Resources for JSPM
For more on dependency caches and bundling with JSPM, see:
- http://jspm.io/docs/production-workflows.html#creating-a-dependency-cache
- http://jspm.io/docs/production-workflows.html#creating-a-bundle
- Commit 9c8306d
- Commit 5598058

For more on JSPM Bundle Arithmetic, see:
- https://github.com/systemjs/builder/tree/0.15.22#bundle-arithmetic
- In particular, https://github.com/systemjs/builder/tree/0.15.22#example---third-party-dependency-bundle
