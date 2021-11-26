const mix = require('laravel-mix');
const webpack = require('webpack');
require('laravel-vue-lang/mix');
require('laravel-mix-svg-vue');

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

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/admin/app.js', 'public/js/admin.js')
    .sass('resources/scss/app.scss', 'public/css/app.css')
    .sass('resources/scss/theme/main.scss', 'public/css/main.css')
    .sass('resources/scss/theme/print.scss', 'public/css/print.css')
    .sass('resources/scss/theme/style.scss', 'public/css/style.css')
    .sass('resources/scss/theme/editor.scss', 'public/css/editor.css')
    .sass('resources/scss/admin/app.scss', 'public/css/admin.css')
    .vue()
    .lang()
    .extract()
    .disableNotifications();

mix.webpackConfig({
    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),
    ],
});


if (mix.inProduction()) {
    mix.minify([
        'public/js/app.js',
        'public/js/vendor.js',
        'public/js/admin.js',
        'public/css/app.js',
        'public/css/admin.js',
    ]);

    mix.version();
} else {
    // Uses source-maps on development
    mix.sourceMaps(false, 'source-map');
    // mix.browserSync(process.env.APP_URL);
}
