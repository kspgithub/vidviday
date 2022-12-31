const mix = require('laravel-mix');
const webpackNodeExternals = require('webpack-node-externals')
const {resolve} = require('path');
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

mix
    .options({
        manifest: false
    })
    .webpackConfig({
        output: {
            globalObject: `typeof self !== 'undefined' ? self : this`,
        },
        target: 'node',
        externals: [webpackNodeExternals()],
        resolve: {
            alias: {
                '@lang': resolve('./resources/lang'),
                '@publicLang': resolve('./public/storage/lang'),
            },
        },
    })

/**
 * *********************
 * Assets
 * *********************
 */
mix.js('resources/js/ssr.js', path.resolve(buildPath, 'ssr.js'))
    .vue({
        version: 3,
        extractStyles: true,
        options: {
            optimizeSSR: true
        }
    })
    .disableNotifications()
.then((stats) => {
    // console.log('Mix Then', stats)


})
