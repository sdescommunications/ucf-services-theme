import { platformBrowserDynamic } from "@angular/platform-browser-dynamic";
import { enableProdMode } from '@angular/core';

import { AppModule }              from "./app.module";

enableProdMode();
platformBrowserDynamic().bootstrapModule(AppModule)
    .then( ( comp_ref ) => {
        window.ucf_app_comp_ref = comp_ref;
        window.ucf_app_instance = comp_ref.instance;
    })
    .catch( err => console.error(err) );


// Boilerplate declarations for type-checking and intellisense.
declare var __moduleName: string;
import { NgModuleRef } from "@angular/core";
// Window from tsserver/lib.d.ts
interface WindowUcf extends Window {
    ucf_app_comp_ref: NgModuleRef<AppModule>; // AppModuleInjector
    ucf_app_instance: AppModule;
}
declare var window: WindowUcf;
