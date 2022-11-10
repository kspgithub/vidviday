const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');
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

mix
    .setResourceRoot('/assets/admin/')
    .setPublicPath(`public/assets/admin`)
    .js('resources/js/admin/app.js', 'public/assets/admin/js')
    .sass('resources/scss/admin/app.scss', 'public/assets/admin/css')
    .purgeCss()
    .lang()
    .extract()
    .disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            '@lang': path.resolve('./resources/lang'),
            '@publicLang': path.resolve('./public/storage/lang'),
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
    const port = 8082

    mix.options({
        hmrOptions: {
            host,
            port,
        }
    })

    console.log('=====================================')
    console.log('Admin host: ' + host)
    console.log('=====================================')

    mix.webpackConfig({
        devServer: {
            host,
            port,
        },
    });

}
