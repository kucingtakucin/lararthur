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

mix.js('resources/js/frontend/app.js', 'public/assets/frontend/js')
    .js('resources/js/backend/app.js', 'public/assets/backend/js')
    .js('resources/js/auth/app.js', 'public/assets/auth/js')
    .sass('resources/sass/frontend/app.scss', 'public/assets/frontend/css')
    .sass('resources/sass/backend/app.scss', 'public/assets/backend/css')
    .sass('resources/sass/auth/app.scss', 'public/assets/auth/css');
