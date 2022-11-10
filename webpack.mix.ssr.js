const mix = require("laravel-mix");
const path = require("path");
const webpackNodeExternals = require('webpack-node-externals')

require('laravel-vue-lang/mix');
require('laravel-mix-svg-vue');

mix
    .setResourceRoot('/assets/app/')
    .setPublicPath(`public/assets/app`)
    .js(`resources/js/ssr.js`, `public/assets/ssr`)
    .vue({
        options: {
            optimizeSSR: true
        }
    })
    .alias({
        '@lang': path.resolve('./resources/lang'),
        '@publicLang': path.resolve('./public/storage/lang'),
    })
    .options({
        processCssUrls: false,
        manifest: false,
    })
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
        output: {
            chunkFilename: path.normalize(`../assets/app/js/chunks/[name].[chunkhash].js`)
        },
    })
    .sourceMaps(false, 'source-map')
    .version()
