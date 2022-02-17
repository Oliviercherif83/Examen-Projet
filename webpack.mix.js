const mix = require("laravel-mix");

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

// compilation avec npm run dev ou npm run watch
mix.js("resources/js/app.js", "public/js")
    // permettre à nos composant vue js d'être compiler
    .vue()

    // avec le sass
    .sass("resources/sass/app.scss", "public/css")
        
    .version()

    /* avec le css classique
    .postCss('resources/css/app.css', 'public/css', [
        
    ]);
    */
