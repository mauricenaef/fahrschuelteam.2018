# Gulp WordPress Boilerplate [![Dependencies](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder/dev-status.svg)](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder?type=dev)

A build system for developing WordPress themes using Gulp. It uses Babel transpiler for JavaScript (ES6) and it bundles CSS with SASS. WordPress Installation is handled by Flywheel.

___

### Features ⚡️
* Processing styles using Gulp SASS
* Babel Transpiler for JavaScript (ES6)
* JavaScript Concatenating and Minification
* Easy import for third party JavaScript libraries
* Image Compression
* SVG Icon Sprite creator
* Fetching latest WordPress version
* Live Reload for PHP Theme Files
* Live CSS Style Injection

___

# Setup ⚙️
This project requires node version 6. This is the only global dependency.
* NodeJS http://nodejs.org/

## Installation ⏳
* Clone Repository: https://github.com/luangjokaj/gulp-wordpress-boilerplate
* Install node packages:
```
$ npm install
```
## Install WordPress 
Use Flywheel to install a local Installation
```
## Development 👾
To start the development server just run the `dev` task:
```
$ npm run dev
```

## Production 🎬
To build the production files run the `prod` task:
```
$ npm run prod
```

## Working Directories
* All the files that you will be working with can be found at: `src/`;
* The `.php` files of the template: `src/theme/`;
* The main `style.css` with the rest of the css includes: `src/style/`;
* Your JavaScript files: `src/js`;

Third party JavaScript libraries can be included in the Gulpfile.js configuration.

All the respective directories (fonts, js, style and theme) have specific watch tasks that run in Gulp.

___

### Technologies 🚀
* NodeJS
* Gulp
* browserSync
* PHP
* Babel
* SASS
* WordPress

___

# Configuration

### Gulpfile.js

The name of the template has to be changed in the Gulp configuration file:

```javascript
/* -------------------------------------------------------------------------------------------------
Theme Name
 ------------------------------------------------------------------------------------------------- */
var fahrschuelteam = 'fahrschuelteam';
```

Adding third party JavaScript libraries is as simple as installing them with NPM Node Package Manager and including the source files in the configuration:

```javascript
var headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/nprogress/nprogress.js',
	'node_modules/aos/dist/aos.js',
	'node_modules/isotope-layout/dist/isotope.pkgd.js'
];
var footerJS = [
	'node_modules/izimodal/js/iziModal.js',
	'src/js/**'
];
```

# Changelog


v0.0.1
* Initial Build
* Add SVG Sprite Icons creator

# License
MIT