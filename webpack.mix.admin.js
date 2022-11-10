const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');
const ip = require('ip');

const host = ip.address() || '0.0.0.0'
const port = 8082

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
    .setResourceRoot(Mix.config.hmr ? path.normalize(`/`) : '/assets/admin/')
    .setPublicPath(`public/assets/admin`)
    .js('resources/js/admin/app.js', 'public/assets/admin/js')
    .sass('resources/scss/admin/app.scss', 'public/assets/admin/css')
    .purgeCss()
    .lang()
    .extract()
    .disableNotifications()
    .options({
        hmrOptions: {
            host,
            port,
        }
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
                'svg-files-path': path.resolve('./resources/svg'),
            },
        },
        output: {
            chunkFilename: path.normalize(`../../assets/admin/js/chunks/[name].[chunkhash].js`)
        },
        module: {
            rules: [
                {
                    test: /resources[\\\/]lang.+\.(php)$/,
                    loader: 'php-array-loader',
                },
            ],
        },
    })
    .sourceMaps(false, 'source-map')
    .version()

