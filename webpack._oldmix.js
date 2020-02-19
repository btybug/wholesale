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

mix.babel([
                'public/js/jQuery3.3.1.js',
                'public/plugins/jquery-ui/jquery-ui.min.js',
            ], 'public/js/bundle/jquery.js')
    .babel([
                'public/plugins/select2/select2.full.min.js',
                'public/js/bootstrap.bundle.min.js',
                'public/js/hover-slider.js',
                'public/js/main.js',
                'public/js/util.js',
                'public/js/register.js',
                'public/js/login.js',
                'public/js/adult.js'
            ], 'public/js/bundle/bundle.js')
    // .babel([
    //     'public/js/media_button_new.js'
    // ], 'public/js/bundle/media.js')
    .babel([
        'public/js/bootstrap-fileinput/js/fileinput.min.js',
        'public/plugins/formstone/mediaquery.js',
        'public/plugins/formstone/touch.js',
        'public/plugins/formstone/carousel/carousel.js',
        'public/js/welcome_carousel.js'
    ], 'public/js/bundle/carousel.js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'public/css/app.css',
        'public/css/custom.css',
        'public/css/fonts.css',
        'public/frontend/css/bootstrap.min.css',
        'public/plugins/jquery-ui/jquery-ui.min.css',
        'public/plugins/select2/select2.min.css',
        'public/css/global.css',
        'public/css/products.css',
        'public/css/product-cards.css',
        'public/css/main.css',
        'public/css/flag-icon.css'
    ], 'public/css/bundle.css')


