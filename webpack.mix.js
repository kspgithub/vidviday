const mix = require('laravel-mix');
const webpack = require('webpack');
const {resolve} = require('path');
const ip = require('ip');
const path = require('path');

const buildPath = path.normalize('public/assets/app')

const host = ip.address() || '0.0.0.0'
const port = 8081


require('laravel-vue-lang/mix');
require('laravel-mix-svg-vue');
require('laravel-mix-purgecss');

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


/**
 * *********************
 * Assets
 * *********************
 */
mix
    .js('resources/js/app.js', path.resolve(buildPath, 'app/js/app.js'))
    .js('resources/js/libs/calendar.js', path.resolve(buildPath, '..', 'app/js/libs/calendar.js'))
    .js('resources/js/libs/markerclusterer.js', path.resolve(buildPath, '..', 'app/js/libs/markerclusterer.js'))
    .js('resources/js/libs/infobox.js', path.resolve(buildPath, '..', 'app/js/libs/infobox.js'))
    .js('resources/js/libs/map.js', path.resolve(buildPath, '..', 'app/js/libs/map.js'))
    .js('resources/js/libs/map-route.js', path.resolve(buildPath, '..', 'app/js/libs/map-route.js'))
    .sass('resources/scss/app.scss', path.resolve(buildPath, 'css/app.css'))
    .sass('resources/scss/theme/main.scss', path.resolve(buildPath, '..', 'app/css/theme/main.css'))
    .sass('resources/scss/theme/print.scss', path.resolve(buildPath, '..', 'app/css/theme/print.css'))
    .sass('resources/scss/theme/style.scss', path.resolve(buildPath, '..', 'app/css/theme/style.css'))
    .sass('resources/scss/theme/editor.scss', path.resolve(buildPath, '..', 'app/css/theme/editor.css'));


/**
 * *********************
 * Common Settings
 * *********************
 */
mix
    .setResourceRoot(`/assets/app/`)
    .setPublicPath(`public/assets/app`)
    .webpackConfig({
        output: {
            chunkFilename: path.normalize(`../../assets/app/js/chunks/[name].[chunkhash].js`)
        },
        resolve: {
            alias: {
                '@lang': resolve('./resources/lang'),
                '@publicLang': resolve('./public/storage/lang'),
            },
        },
        module: {
            rules: [
                {
                    test: /resources[\\\/]lang.+\.(php)$/,
                    loader: 'php-array-loader',
                },
            ],
        },
        plugins: [
            new webpack.DefinePlugin({
                __VUE_OPTIONS_API__: true,
                __VUE_PROD_DEVTOOLS__: false,
                __VUE_I18N_FULL_INSTALL__: true,
                __VUE_I18N_LEGACY_API__: false,
                __INTLIFY_PROD_DEVTOOLS__: false,
            }),
        ],
    })
    .vue()
    .lang()
    .extract()
    .sourceMaps(false, 'source-map')
    .disableNotifications();


/**
 * *********************
 * Production Settings
 * *********************
 */
if (mix.inProduction()) {
    // !!! Dont need to minify.
    // Laravel Mix automatically minifies js as css files in production
    // mix.minify([
    //     'public/js/app.js',
    //     'public/js/vendor.js',
    //     'public/js/admin.js',
    //     'public/css/app.css',
    //     'public/css/admin.css',
    // ]);

    mix.version();
}

/**
 * *********************
 * Development Settings
 * *********************
 */
if (!mix.inProduction() && Mix.config.hmr) {

    console.log('=====================================')
    console.log('App host: ' + host)
    console.log('=====================================')

    mix
        .options({
            hmrOptions: {
                host,
                port,
            }
        })
        .setResourceRoot(path.normalize(`/`))
        .webpackConfig({
            output: {chunkFilename: 'js/chunks/[name].[chunkhash].js'},
            devServer: {host, port}
        });

}
