const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')
const ip = require('ip')

const host = ip.address() || '0.0.0.0'
const port = 8081

require('laravel-vue-lang/mix')
require('laravel-mix-svg-vue')
require('laravel-mix-purgecss')
require('laravel-mix-merge-manifest')
require('laravel-mix-php-manifest')

mix.lang()
mix.mergeManifest()
mix.phpManifest()

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

mix.js('resources/js/app.js', 'public/assets/app/js')
    .sass('resources/scss/theme/main.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/print.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/style.scss', 'public/assets/app/css')
    .sass('resources/scss/theme/editor.scss', 'public/assets/app/css')
    .vue()
    .extract()
    .disableNotifications()
    .sourceMaps(false, 'source-map')
    .alias({
        'svg-files-path': path.resolve(__dirname, 'resources/svg'),
        '@': path.resolve(__dirname, 'resources'),
        '@svg': path.resolve(__dirname, 'resources/svg'),
        '@lang': path.resolve(__dirname, 'resources/lang'),
        '@publicLang': path.resolve(__dirname, 'public/storage/lang'),
    })
    .autoload({
        jquery: ['$', 'jQuery', 'window.jQuery'],
    })
    .webpackConfig({
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
                __DATA__: JSON.stringify({ name: 'Dewrw' }),
            }),
        ],
    })
    .version()
