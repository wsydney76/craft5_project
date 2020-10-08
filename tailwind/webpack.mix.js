const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.sass('./src/styles/style.scss', '../web/assets/dist/main.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
