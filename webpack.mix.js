const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/reset.scss', 'public/css')
    .sass('resources/css/app.scss', 'public/css')
    .copy('resources/img', 'public/images', false)
    .vue()
    .webpackConfig({
        resolve: {
            alias: {
                '~': path.resolve(__dirname, '../node_modules/'),
                '@': path.resolve(__dirname, 'resources/js/')
            }
        }
    });
