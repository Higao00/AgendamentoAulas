const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css')
    .css('node_modules/bootstrap-icons/font/bootstrap-icons.css', 'public/css/bootstrap-icons.css')
    .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .scripts('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.js', 'public/js/bootstrap.js');