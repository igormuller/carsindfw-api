const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/app.scss', 'resources/css/app.css')
   .combine('resources/js/libs', 'public/js/merged.js')
   .combine('resources/css', 'public/css/app.css')
   .copy('resources/js/scripts.js.download', 'public/js/scripts.js.download');