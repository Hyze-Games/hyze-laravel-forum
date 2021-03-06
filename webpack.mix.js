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
mix.webpackConfig(require('./webpack.config'));

// Forum
mix.js('resources/forums/js/app.js', 'public/assets/forums/js')
    .sass('resources/forums/sass/app.scss', 'public/assets/forums/css', {
        data: "$env: " + process.env.NODE_ENV + ";"
    });

// Admin
mix.js('resources/admin/js/app.js', 'public/assets/admin/js')
    .sass('resources/admin/sass/app.scss', 'public/assets/admin/css', {
        data: "$env: " + process.env.NODE_ENV + ";"
    });

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
