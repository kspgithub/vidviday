const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require("path");
const ip = require('ip');

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

mix
    .setResourceRoot(Mix.config.hmr ? path.normalize(`/`) : '/assets/app/')
    .setPublicPath(`public/assets/app`)
    .js('resources/js/app.js', 'public/assets/app/js')
    .sass('resources/scss/theme/main.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/print.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/style.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/editor.scss', 'public/assets/app/css')
    .purgeCss()
    .vue({
        extractStyles: true,
    })
    .lang()
    .extract()
    .disableNotifications()
    .options({
        processCssUrls: false,
        hmrOptions: {
            host,
            port,
        },
    })
    .webpackConfig({
        devServer: {
            host,
            port,
        },
        resolve: {
            alias: {
                '@lang': path.resolve('./resources/lang'),
                '@publicLang': path.resolve('./public/storage/lang'),
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
        output: {
            chunkFilename: Mix.config.hmr ? 'js/chunks/[name].[chunkhash].js' : path.normalize(`../../assets/app/js/chunks/[name].[chunkhash].js`)
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
    .sourceMaps(false, 'source-map')
    .version()
