# ucf-services-theme
Theme for the services page on ucf.edu.


## Table of Contents
* [Installation Requirements](#installation-requirements)
* [Important files/folders](#important-filesfolders)
* [Notes](#notes)
* [Quick Install](#quick-install)
* [Virtual Machine for Local Development](#virtual-machine-for-local-development)
* [Installing Required Development Tools](#installing-required-development-tools)
* [Development Toolset](#development-toolset)

## Installation Requirements:
- [WordPress](https://wordpress.org/) [4.6.1+](https://codex.wordpress.org/Version_4.6.1) (untested on previous versions)

### Libraries Used (Open-Source):
Included with repository. See composer.json, bower.json, and package.json for version details.
- [Anahkiasen/Underscore-php](https://github.com/Anahkiasen/underscore-php) - PHP utility functions.
- [Bootstrap 3](getbootstrap.com/css/) - mobile-first and responsive front-end framework.
- [Font Awesome 4](http://fontawesome.io/) - the iconic font and css toolkit.
- [Weather Icons](https://erikflowers.github.io/weather-icons/) - weather-themed icons and css.

### Libraries Used (Closed-Source):
- [Gravity Forms](http://www.gravityforms.com/) - form in site footer (requires a license).

### WordPress Libraries Used:
 The following libraries are provided by WordPress:
- [jQuery](http://jquery.com/) - Javascript utility functions, including HTML document traversal and manipulation, event handling, animation, and Ajax.
- [SimplePie](http://simplepie.org/) - feed parser.
- [WordPress REST API (version 2)](https://wordpress.org/plugins/rest-api/) - access WordPress data through an HTTP REST API (this will eventually be integrated with WordPress Core).

### Required Development Tools
- [NodeJS](https://nodejs.org/) v6.9.1+
- [Bower](https://bower.io/) v1.7.9+
- [Sass](http://sass-lang.com/) (developed on [Koala](http://koala-app.com/) v2.0.4+)
- [Composer](https://getcomposer.org/) v1.1.2+


## Important files/folders

### docs/
Folder for this repo's [GitHub Pages site](http://ucf-sdes-it.github.io/ucf-services-theme/), including generated code documentation.

### functions.php
The entry point for a WordPress theme, along with the style.css file. It includes or references all functionality for a theme.<br>
This should be used for requiring other files (group all require statements at the top).

### static/
Where, aside from style.css in the root, all compiled/minified, theme-specific static
content such as javascript, images, and css should live.
Currently, legacy code also references static files in css/ and js/.

### src/
Where static assets such as scss partials and unminified javascript should live.
With the exception of files in src/components/ (see below), the files in this directory
should be used to modify styles and logic on the frontend (do not modify minified
assets in static/.)

### src/components/
Where static assets installed by Bower should live.  Contents in this directory
should be ignored by the repo and are referenced only when running scripts (e.g., compiling Sass).

### custom-posttypes.php
Create Custom Posttypes by inheriting from `CustomPostType` in `functions/class-custom-posttype.php`.<br>
The class `CustomPostType` centralizes posttype functionality, facilitates shortcode creation 
(displaying a list of posts), and abstracts other implementation details.<br>
Custom Posttypes must be passed to `CustomPostType::Register_Posttypes` (see `register_custom_posttypes` for examples).

### custom-taxonmies.php
Create Custom Taxonomies by inheriting from `CustomTaxonomy` in `functions/class-custom-taxonomy.php`.<br>
The class `CustomTaxonomy` centralizes taxonomy functionality and abstracts implementation details.
Custom Taxonomies must be passed to `CustomTaxonomy::Register_Taxonomies` (see `register_custom_taxonomies` for examples).

### shortcodes.php
Define Wordpress shortcodes here by inheriting from `ShortcodeBase` in `functions/class-shortcodebase`.<br>
The class `ShortcodeBase` extends shortcode functionality to add UI for shortcode creation.<br>
See example shortcodes for more information.

### Template Hierarchy files
This theme relies on `front-page.php` and falls back to `index.php`.
For more details, see the [WordPress Theme Handbook](https://developer.wordpress.org/themes/basics/template-hierarchy/)
or https://wphierarchy.com/

#### Header and Footer
Calls to `get_header()` and `get_footer()` resolve to header.php and footer.php respectively.
Theme Customizer settings for the `Footer` class are located in `footer-settings.php`.

### functions/ThemeCustomizer.php
Add and configure Theme Customizer options for this theme (non-admin settings). This relies on
implementation in SDES_Customizer_Helper, a wrapper aimed toward reducing boilerplate code.

### functions/class-sdes-static.php
Utility methods that are static, pure functions, and fit for reuse in other projects.

### tests/
Unit tests and codesniffer configuration files.

### vendor/
Third-party libraries installed by Composer that are required by this theme. Production dependences, 
such as `anahkiasen/underscore-php`, have been saved to the repository to simplify deployment.


## Notes

This theme utilizes Twitter Bootstrap as its front-end framework.  Bootstrap
styles and javascript libraries can be utilized in theme templates and page/post
content.  For more information, visit http://twitter.github.com/bootstrap/

Note that this theme may not always be running the most up-to-date version of
Bootstrap.  For the most accurate documentation on the theme's current
Bootstrap version, visit http://bootstrapdocs.com/ and select the version number
found at the top of `components/bootstrap-sass-official/bower.json`.


## Quick Install
- If you do not have the "Required Development Tools" installed, first see [Installing Required Development Tools](#installing-required-development-tools) below.
- If you would like to use a virtual machine for your WordPress environment, first see [Virtual Machine for Local Development](#virtual-machine-for-local-development).
- Otherwise, assuming you already have a WordPress/PHP/MySQL environment:

1. Clone this repository to the "www\wordpress\wp-content\themes\" folder:<br>
`git clone https://github.com/ucf-sdes-it/ucf-services-theme.git` and `cd ucf-services-theme`.

2. Choose whether to install javascript utilities globally (`npm run-script install:global`) or
locally to the node_modules folder (`npm install`). See package.json for version details.

3. Run `bower install` to install web front-end components from bower.json 
(bootstrap, fontawesome, weathericons, etc.).

4. Compile Sass to CSS using your preferred method. For example, using
[Koala](http://koala-app.com/), drag in the project folder (which contains
a koala-config.json file).

5. To use PHP utilities, install them with Composer, either globally (`composer run-script install:global`),
or locally to the vendor folder (`composer install`). See composer.json for version details.

Optional:
1. If the FontAwesome version is updated or icons are missing, run
`node -e ./scripts/write_fa_icons_list.js` to update `static/data/fa-icons.json`.

2. Run `composer phpdoc:all` to compile the `docs` folder (see below for details on installing PHPDoc and GraphViz).


## Virtual Machine for Local Development
[VCCW](http://vccw.cc/) is a configuation/stack for setting up a virtual development environment with Vagrant + VirtualBox + CentOS + Chef + WordPress.
* [Vagrant](https://www.vagrantup.com/) spins up a virtual machine harddrive from a template "box".
* [VirtualBox](https://www.virtualbox.org/) runs the virtual machine.
* [CentOS](https://www.centos.org/) is a redhat compatible Linux distro.
* [Chef](https://www.chef.io/chef/)<sup id="a1">[1](#fn1)</sup> is used for configuration management.
* [WordPress](https://wordpress.org/) is already installed with all requirements/dependencies, along with a suite of development tools, including [WP-CLI](http://wp-cli.org/), [PHP Composer](https://getcomposer.org/), and [PHPUnit](https://phpunit.de/).


### Initial setup notes:
See [VCCW homepage](http://vccw.cc/) for more details.

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads). The installer may temporarily disable the network and/or require a restart.
2. Install [Vagrant](https://www.vagrantup.com/downloads.html). This may require a restart (adds to $env:PATH).
3. Download the vccw harddrive image with vagrant: `vagrant box add miya0001/vccw --box-version ">=2.19.0"` (this may take a long time -- 1.55GB+ download)
4. Create a folder for the Vagrant virtual machine (based on, for example: https://github.com/vccw-team/vccw/archive/2.20.0.zip)
5. From cmd.exe or powershell, `cd` into the directory.
6. Make a site.yml file in the Vagrant directory via: `cp provision\default.yml site.yml` and edit the following values:
   ```
   multisite: true
   plugins:
     - dynamic-hostname
     - wp-total-hacks
     - tinymce-templates
     - what-the-file
     - wordpress-mu-domain-mapping
     - rest-api
     - wordpress-importer
     - wp-allow-hosts
   ```
   Note, the above plugin names can be appended to: `https://wordpress.org/plugins/` to find their details pages.

7. `vagrant up` (initial provisioning may take several minutes).
8. Add an entry to your HOSTS file<sup id="a2">[2](#fn2)</sup>. for the VM's IP address<sup id="a3">[3](#fn3)</sup>.: `192.168.33.10 services-theme.dev`
9. Clone this repository to the "www\wordpress\wp-content\themes\" folder of your vccw-x.xx.x installation. Use either GitHub for windows or `git clone https://github.com/ucf-sdes-it/ucf-services-theme.git`<sup id="a4">[4](#fn4)</sup>.
10. Access the WordPress install in your browser from http://services-theme.dev/ or http://192.168.33.10 and develop as normal.  The following Vagrant commands may prove useful:
  - Start/Recreate VM: `vagrant up`
  - Suspend VirtualBox VM:  `vagrant suspend`
  - Resume VirtualBox VM:   `vagrant resume`
  - Shutdown VirtualBox VM: `vagrant halt`
  - Restart and reload Vagrantfile: `vagrant reload`
  - Delete VM (leaves directory from step 4 intact): `vagrant destroy` (this may take several minutes).<br>
  Consult `vagrant help` or the [Vagrant Documentation](https://www.vagrantup.com/docs/) for additional information.
11. Remember to "Network Activate" the theme from http://services-theme.dev/wp-admin/network/themes.php


### Optional Installation Steps

1. To use PHPDoc:
  - Install PHPDoc on your system with: `composer global require phpdocumentor/phpdocumentor=2.8.*`
  - If [GraphViz](http://graphviz.org/Download..php) is not installed on your system, it needs to be installed (tested with [graphviz-2.38.msi](http://graphviz.org/Download_windows.php) on Windows 8).
  - Make sure to add the GraphViz bin folder (`C:\Program Files (x86)\Graphviz2.38\bin`) to your PATH.
  - Run `composer phpdoc:all` to compile the `docs` folder (this make take a few minutes the first time it is run).
2. Install [vagrant-multi-putty](https://github.com/nickryand/vagrant-multi-putty) with `vagrant plugin install vagrant-multi-putty`.  This enables the command `vagrant putty` to open an SSH session using PuTTY<sup id="a5">[5](#fn5)</sup>.

VCCW also offers another VM specifcally for [Theme Reviewing](https://github.com/vccw-team/vccw-for-theme-review).
Testing in a fresh environment could be useful after feature completion, whether for a feature branch or alpha testing.


## Installing Required Development Tools
If you do not have required development tools installed already, follow the instructions below.  Note that the VCCW virtual machine comes with many of these already pre-installed.

### NodeJS
- Install NodeJS v6.9.1 (or later) from the [NodeJS homepage](https://nodejs.org/en/). [(v6.9.1 windows x64 installer)](https://nodejs.org/dist/v6.9.1/node-v6.9.1-x64.msi). If you need NodeJS for other projects, you may want to use [Node Version Manager (nvm)](https://github.com/creationix/nvm) on *nix systems or [nvm-windows](https://github.com/coreybutler/nvm-windows) on Windows.

### Bower
- After NodeJS is installed, run `npm install -g bower` from the commandline.

### SCSS
- On Windows, you can choose to run the Koala installer from the [Koala homepage](http://koala-app.com/).
- Otherwise, follow the SASS installation instructions found on: http://sass-lang.com/install

### Composer
Composer requires PHP to be installed on your development system.

1. Install PHP, if it is not already installed: 
  - On Windows, via the (Microsoft Web Platform Installed)[http://www.microsoft.com/web/downloads/platform.aspx] - select 'PHP 5.6.0 for IIS Express' (or a later version of PHP).
  - Or, follow the [PHP installation documentation](http://php.net/manual/en/install.php).
2. Install Composer from https://getcomposer.org/download/
  - On Windows:
    - Download and run https://getcomposer.org/Composer-Setup.exe
    - Verify that %APPDATA%\Composer\vendor\bin has been added to your PATH enviornment variable.
  - On other platforms: follow the official [Composer command-line installation instructions](https://getcomposer.org/download/).


## Development Toolset
Overview of recommended development tools for coding.

### Package Management - Composer
Manage package dependencies.  This can streamline upgrading library files.
[Composer](http://www.getcomposer.org)

Similar to: PEAR (PHP), NuGet (.NET), NPM (NodeJS package manager), or Bower (front-end webdev)



### CSS Preprocessor - SASS (via Koala)
A CSS extension language that adds: variables, nesting, partials, mixings, inheritance, operators, and other language features.

Similar to (interface): Scout, Compass.app.<br>
Similar to (manual): Ruby sass gem from commandline (Ruby), gulp-js (NodeJS, requires Ruby).<br>
Alternatives: Stylus Language, LESS Language.



### Unit Testing - PHPUnit
Library used to test small units of code (e.g. functions, classes). May measure coding metrics, often in conjunction with other tools.
PHPUnit - popular testing library for PHP that uses the xUnit architecture.

Similar to: NUnit (.NET), MSTest (.NET), JUnit (Java), etc.<br>
Related to: Code Analysis (.NET Visual Studio)



### Other testing
Libraries used to test for integration (of multiple system components), functionality, and user acceptance conditions.

### Code Standards Checker - PHPCodeSniffer
Automatically check code against a set of rules/standards.
PHPCodeSniffer is a popular tool for standardizing PHP code.
Commands:
* phpcs (php code sniffer)
* phpcbf (php code beautifier and fixer)
* jscs (javascript code sniffer)

Similar to: StyleCop (.NET), JSHint (javascript), JSLint (javascript)<br>
Related to: Lint programs (syntax checkers)


### Documentation Generator - phpDocumentor
Tooling to extract and format documentation from specially-formatted code comments (docblocks).<br>
phpDocumentor - popular php documentation program that uses xDoc style formatting.<br>
phpDocumentor is installed in the VCCW virtual machine. To run locally, either install systemwide using: `composer global require phpdocumentor/phpdocumentor=2.8.*` (preferred) or download the PHP archive (.PHAR file) from http://phpdoc.org/phpDocumentor.phar.

NOTE: PHPDocumentor requires [GraphViz](http://graphviz.org/Download..php) to be installed on your system: http://graphviz.org/Download_windows.php (tested with graphviz-2.38.msi on Windows 8).<br>
Make sure to add `C:\Program Files (x86)\Graphviz2.38\bin` to your PATH.

Similar to: javadoc, jsdoc<br>
Alternatives: phpDox, Sami, Doxygen, Apigen. (Switching or supplementing with these might make sense, e.g., phpDox includes code metrics, Sami generates an index view).



### Browser Testing - Selenium, BrowserStack
Library and tools to test browser interactions.
#### Selenium
A library and set of tools that allow you to programmatically control a browser.  It has bindings in multiple languages (including C# and PHP), though the most popular one is Java.

Related to: BrowserStack (extension service to test on multiple devices)<br>
Similar to: PhantomJS (javascript), HttpUnit (Java), Watir (Ruby web testing)


#### Browserstack
A service that facilitates testing on multiple browser types, versions, and OSes (including mobile).


--
<a id="fn1"/>[^1](#a1): Specifcally, [Chef Solo](https://docs.chef.io/chef_solo.html)

<a id="fn2"/>[^2](#a2): Hosts file on windows: c:\Windows\System32\drivers\etc\hosts (must edit as administrator).

<a id="fn3"/>[^3](#a3)</span>: By default, VCCW uses Virtualbox's [NAT networking mode](http://www.virtualbox.org/manual/ch06.html#network_nat) for Adapter 1 and [Host-only networking](http://www.virtualbox.org/manual/ch06.html#network_hostonly) for Adapter 2.

<a id="fn4"/>[^4](#a4): You may want to add an NTFS junction point* that links from your c:\github folder and targets the cloned folder's location. From cmd.exe, run `mklink /j` (or using Powershell Community Extenions, `new-junction`). Creating a junction in the other direction (targeting the vccw folder) will be difficult/impossible due to Virtualbox security concerns, involving the setting ```VBoxManage.exe setextradata <VM Name> VBoxInternal2/SharedFoldersEnableSymlinksCreate/<volume> 1```.

<a id="fn5"/>[^5](#a5): [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) is a windows and *nix client for SSH, telnet, and rlogin. To use the VM's private key instead of a password every time, follow [these instructions](https://github.com/nickryand/vagrant-multi-putty#ssh-private-key-conversion-using-puttygen) with `vccw-x.xx.x\.vagrant\machines\services-theme.dev\virtualbox\private_key`.

*[NTFS junction point]: See https://en.wikipedia.org/wiki/NTFS_junction_point and http://www.hanselman.com/blog/MoreOnVistaReparsePoints.aspx
