#!/usr/bin/env node
var childProcess = require('child_process'),
    fs = require('fs');;

var buildmap = {
    'search-results._template.js':  __dirname + `/../src/ts/search-results._template.js`,
    'search-form._template.js':  __dirname + `/../src/ts/search-form._template.js`,
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
        Usage: search-results._template.js [-x --execute] [-w|--watch]
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
    fs.watch( (__dirname + `/../src/ts/`), (event, filename) => {
        // console.log(`event is: ${event}`);
        if ( buildmap[filename] ) {
            childProcess.fork( buildmap[filename], ['-x'] );
        }
    });
}
