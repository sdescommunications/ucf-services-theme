#!/usr/bin/env node
var childProcess = require('child_process'),
    fs = require('fs'),
    path = require('path');

var buildmap = {
    'results._template.js':  __dirname + `/../ng-app/app-student-services/search/results/results._template.js`,
    'form._template.js':  __dirname + `/../ng-app/app-student-services/search/form/form._template.js`,
    'filter._template.js':  __dirname + `/../ng-app/app-student-services/search/filter/filter._template.js`,
};

function BuildTemplates() {
    for(var script in buildmap ) {
        childProcess.fork( buildmap[script], ['-x'] );    
    }
}
exports.BuildTemplates = BuildTemplates;


try{
    // Run with neodoc if installed, or catch and fail gracefully.
    const neodoc = require('neodoc');
    args = neodoc.run(`
        Commander script to run build scripts (and watch their depedency files).
        Usage: build_template.js [-x --execute] [-w|--watch]
        Options:
            -x --execute    Run BuildTemplates()
            -w --watch    Watch depedencies.`);
} catch (e) {
    args = {
        '-x': process.argv[2] == '-x',
        '-w': process.argv[2] == '-w',
    };
}

if ( args['-x'] ) {
    BuildTemplates();
}

if ( args['-w'] ) {
    console.log('Watching for templates...\n');
    fs.watch( (__dirname + `/../ng-app/`), { recursive: true }, (event, filename) => {
        // console.log(`event is: ${event}`);
        filename = path.basename(filename);
        if ( buildmap[filename] ) {
            childProcess.fork( buildmap[filename], ['-x'] );
        }
    });
}
