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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
    ])

    /* Adding Semantic UI assets */
    .copy('node_modules/fomantic-ui/dist/semantic.min.css', 'public/assets/semantic/semantic.min.css')
    .copy('node_modules/fomantic-ui/dist/semantic.min.js', 'public/assets/semantic/semantic.min.js')
    .copy('node_modules/fomantic-ui/dist/themes/', 'public/assets/semantic/themes/');

//mix.sass('resources/sass/app.scss', 'public/css');
