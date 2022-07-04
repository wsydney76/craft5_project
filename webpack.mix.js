const mix = require('laravel-mix');
const path = require("path");
require('laravel-mix-clean');

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

mix.setPublicPath('web')
    .js("src/js/app.js", "web/assets/dist/js")
    .postCss("src/css/app.css", "web/assets/dist/css", [
        require("tailwindcss")
    ])
    .disableSuccessNotifications()
    .version()
    .clean({
        cleanOnceBeforeBuildPatterns: ['assets/dist']
    });

// New Alias plugin
mix.alias({
    "@": path.resolve("src/js"),
});
