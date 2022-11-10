const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')
const ip = require('ip')

const host = ip.address() || '0.0.0.0'
const port = 8081

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

mix
    .setResourceRoot('/assets/app/')
    .setPublicPath(`public/assets/app`)
    .js('resources/js/app.js', path.normalize('public/assets/app/js'))
    .sass('resources/scss/theme/main.scss', path.normalize('public/assets/app/css'))
    .sass('resources/scss/theme/print.scss', path.normalize('public/assets/app/css'))
    .sass('resources/scss/theme/style.scss', path.normalize('public/assets/app/css'))
    .sass('resources/scss/theme/editor.scss', path.normalize('public/assets/app/css'))
    .vue()
    .lang()
    .extract()
    .disableNotifications()
    .alias({
        'svg-files-path': path.resolve(__dirname, 'resources/svg'),
        '@svg': path.resolve(__dirname, 'resources/svg'),
        '@lang': path.resolve(__dirname, 'resources/lang'),
        '@publicLang': path.resolve(__dirname, 'public/storage/lang'),
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
        output: {
            chunkFilename: path.normalize(`../../assets/app/js/chunks/[name].[chunkhash].js`),
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

if (Mix.config.hmr) {
    mix.setResourceRoot(path.normalize(`/`))
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].[chunkhash].js'
        }
    });
}

if(mix.inProduction()) {
    mix.version()
} else {
    // Uses source-maps on development
    mix.sourceMaps(true, 'source-map');
}


mix.options({
    hmrOptions: {
        host,
        port,
        useLocalIp: true,
    },
    devServer: {
        disableHostCheck: true,
    }
});
