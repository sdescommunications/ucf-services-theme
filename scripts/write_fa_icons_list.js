/**
 * Write a list of Font-Awesome icons to /static/data/fa-icons.json.
 * @see: https://github.com/UCF/Students-Theme/blob/master/gulpfile.js#L134-L156
 */
var fs = require('fs'),
    readline = require('readline'),
    configLocal = null;
    try { configLocal = require('./config.json'); } catch (e){}

var configDefault = {
      dataPath: __dirname + '/../static/data',
      componentsPath: __dirname + '/../src/components',
    },
    config = Object.assign(configDefault, configLocal);

// Get list of font-awesome icons
var write_fa_icons_list = function() {
    var stream = fs.createReadStream(config.componentsPath + '/font-awesome/scss/_icons.scss');
    stream.on('error', function(err) { console.log(err); });

    var reader = readline.createInterface({
       input: stream
    });

    // A span beginning with '.#{$fa-css-prefix}-', followed by any number of characters (captured in match[1]), followed by ':before'.
    var regex = /\.#\{\$fa-css-prefix\}-(.*):before/,
        icons = [];

    reader.on('line', function(line) {
       var match = regex.exec(line);
       if (match) {
           icons.push("fa-" + match[1]);
       }
    }).on('close', function() {
        fs.writeFile(config.dataPath + '/fa-icons.json', JSON.stringify(icons) + '\n', function (err) {
            if (err) { console.log(err); } else { console.log("Font awesome list written."); }
        });
    });
};
write_fa_icons_list();
