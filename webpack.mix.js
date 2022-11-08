const mix = require('laravel-mix');
const webpack = require('webpack');
const { resolve } = require('path');
const ip = require('ip');

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

mix.setPublicPath(`public/assets/app`)
    .js('resources/js/app.js', 'public/assets/app/js/app.js')
    .sass('resources/scss/app.scss', 'public/assets/app/css/app.css')
    .sass('resources/scss/theme/main.scss', 'public/assets/app/css/main.css')
    .sass('resources/scss/theme/print.scss', 'public/assets/app/css/print.css')
    .sass('resources/scss/theme/style.scss', 'public/assets/app/css/style.css')
    .sass('resources/scss/theme/editor.scss', 'public/assets/app/css/editor.css')
    .purgeCss()
    .vue()
    .lang()
    .extract()
    .disableNotifications();

mix.webpackConfig({
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
});

mix.sourceMaps(false, 'source-map');

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
} else {
    // Uses source-maps on development

    // mix.browserSync(process.env.APP_URL);


    const host = ip.address() || '0.0.0.0'
    const port = 8081

    mix.options({
        hmrOptions: {
            host,
            port,
        }
    })

    console.log('=====================================')
    console.log(host)
    console.log('=====================================')

    mix.webpackConfig({
        devServer: {
            host,
            port,
        },
    });

}
