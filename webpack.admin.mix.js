const mix = require('laravel-mix')
const webpack = require('webpack')
const {resolve} = require('path')
const ip = require('ip')

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

mix.setResourceRoot(mix.inProduction() ? `/assets/admin/` : `/`)
    .setPublicPath(`public/assets/admin`)
    .extract()
    .disableNotifications()
    .sourceMaps(false, 'source-map')
    .webpackConfig({
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

mix.sourceMaps(false, 'source-map')

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

    mix.version()
} else {
    // Uses source-maps on development

    // mix.browserSync(process.env.APP_URL);

    const host = ip.address() || '0.0.0.0'
    const port = process.env.DEV_SERVER_ADMIN_PORT || 8082

    mix.options({
        hmrOptions: {host, port},
    })
    mix.webpackConfig({
        devServer: {host, port},
    })

    console.log('=====================================')
    console.log('Admin host: ' + host)
    console.log('Admin port: ' + port)
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
 * Admin Assets
 * *********************
 */
mix.js('resources/js/admin/app.js', 'public/assets/admin/js/admin.js')
    .sass('resources/scss/admin/app.scss', 'public/assets/admin/css/admin.css')
