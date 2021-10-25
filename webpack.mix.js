const mix = require('laravel-mix');
require('mix-tailwindcss');
require ('babel-polyfill');
require('laravel-mix-polyfill');
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

const TargetsPlugin = require('targets-webpack-plugin');
mix.webpackConfig({
    plugins: [
        new TargetsPlugin({
            browsers: ['last 2 versions', 'chrome >= 41', 'IE 11'],
        }),
    ]});
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css/')
    .tailwind()
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: {"ie": 11},
        debug: true,
        corejs: 3,
    });
