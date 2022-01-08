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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

//mix css

// mix.styles([
//     'public/app-assets/vendors/css/vendors.min.css',
//     'public/app-assets/vendors/css/charts/morris.css',
//     'public/app-assets/vendors/css/charts/chartist.css',
//     'public/app-assets/vendors/css/charts/chartist-plugin-tooltip.css',
//     'public/app-assets/css/bootstrap.css',
//     'public/app-assets/css/bootstrap-extended.css',
//     'public/app-assets/css/colors.css',
//     'public/app-assets/css/components.css',
//     'public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css',
//     'public/app-assets/css/core/colors/palette-gradient.css',
//     'public/app-assets/css/core/colors/palette-gradient.css',
//     'public/app-assets/css/pages/timeline.css',
//     'public/app-assets/css/pages/dashboard-ecommerce.css',
//     'public/app-assets/css/components.css'
// ], 'public/app-assets/css/all.css');

