const mix = require('laravel-mix')
const webpack = require('webpack')
const ip = require('ip')
const path = require('path')
const fs = require('fs')

const buildPath = path.normalize('public/assets/app')

require('laravel-vue-lang/mix')
require('laravel-mix-svg-vue')
require('laravel-mix-purgecss')

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

mix.setResourceRoot(mix.inProduction() ? `/assets/app/` : `/`)
    .setPublicPath(`public/assets/app`)
    .extract()
    .disableNotifications()
    .sourceMaps(false, 'source-map')
    .webpackConfig({
        output: {
            chunkFilename: mix.inProduction()
                ? path.normalize(`../../assets/app/js/chunks/[name].[chunkhash].js`)
                : 'js/chunks/[name].[chunkhash].js',
        },
        resolve: {
            alias: {
                '@': path.resolve('./resources/lang'),
                '@lang': path.resolve('./resources/lang'),
                '@publicLang': path.resolve('./public/storage/lang'),
                'vue': 'vue/dist/vue.esm-bundler.js',
                'vue-i18n': 'vue-i18n/dist/vue-i18n.cjs.js',
            },
        },
        optimization: {
            providedExports: false,
            sideEffects: false,
            usedExports: false
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

if (mix.inProduction()) {

    mix.version();
} else {
    // mix.browserSync({proxy,});

    const host = ip.address() || '0.0.0.0'
    const port = process.env.DEV_SERVER_APP_PORT || 8081

    mix.options({
        hmrOptions: {host, port},
    })
    mix.webpackConfig({
        devServer: {host, port},
    })

    console.log('=====================================')
    console.log('App host: ' + host)
    console.log('App port: ' + port)
    console.log('=====================================')

    if (process.env.DEV_SERVER_SSL && process.env.DEV_SERVER_KEY) {
        const proxy = process.env.APP_URL.replace(/^(https?:|)\/\//, '')
        mix.options({
            hmrOptions: {
                host: proxy,
                port,
                https: {
                    key: process.env.DEV_SERVER_KEY,
                    cert: process.env.DEV_SERVER_CERT,
                },
            },
        })
        mix.webpackConfig({
            devServer: {
                host: proxy,
                port,
                https: {
                    key: process.env.DEV_SERVER_KEY,
                    cert: process.env.DEV_SERVER_CERT,
                },
            },
        })
    }
}

/**
 * *********************
 * App Assets
 * *********************
 */
mix
    .js('resources/js/app.js', path.resolve(buildPath, 'js/app.js'))
    .js('resources/js/libs/calendar.js', path.resolve(buildPath, '..', 'app/js/libs/calendar.js'))
    .js('resources/js/libs/markerclusterer.js', path.resolve(buildPath, '..', 'app/js/libs/markerclusterer.js'))
    .js('resources/js/libs/infobox.js', path.resolve(buildPath, '..', 'app/js/libs/infobox.js'))
    .js('resources/js/libs/sharer.js', path.resolve(buildPath, '..', 'app/js/libs/sharer.js'))
    .js('resources/js/libs/map.js', path.resolve(buildPath, '..', 'app/js/libs/map.js'))
    .sass('resources/scss/app.scss', path.resolve(buildPath, 'css/app.css'))
    .sass('resources/scss/theme/main.scss', path.resolve(buildPath, '..', 'app/css/theme/main.css'))
    .sass('resources/scss/theme/print.scss', path.resolve(buildPath, '..', 'app/css/theme/print.css'))
    .sass('resources/scss/theme/style.scss', path.resolve(buildPath, '..', 'app/css/theme/style.css'))
    .sass('resources/scss/theme/editor.scss', path.resolve(buildPath, '..', 'app/css/theme/editor.css'))
    .vue()
    .lang()
    .svgVue()
