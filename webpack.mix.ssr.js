const mix = require('laravel-mix');
const webpack = require('webpack');
const {resolve} = require('path');
const ip = require('ip');
const path = require('path');

const buildPath = path.normalize('public/assets/ssr')

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

mix.webpackConfig({
        output: {
            chunkFilename: mix.inProduction()
                ? path.normalize(`../../assets/app/js/chunks/[name].[chunkhash].js`)
                : 'js/chunks/[name].[chunkhash].js'
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

/**
 * *********************
 * Assets
 * *********************
 */
mix.js('resources/js/ssr.js', path.resolve(buildPath, 'ssr.js'))
    .vue()
    .lang()
    .sourceMaps(false, 'source-map')
    .disableNotifications()
    .extract()
    // .purgeCss()
