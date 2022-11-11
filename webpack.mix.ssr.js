const mix = require('laravel-mix')
const path = require('path')
const webpackNodeExternals = require('webpack-node-externals')

require('laravel-vue-lang/mix')
require('laravel-mix-svg-vue')
require('laravel-mix-merge-manifest')
require('laravel-mix-php-manifest')

mix.lang()
mix.svgVue()
mix.mergeManifest()
mix.phpManifest()

mix.js(`resources/js/ssr.js`, `public/assets/ssr`)
    .vue({
        options: {
            optimizeSSR: true,
        },
    })
    .alias({
        '@lang': path.resolve('./resources/lang'),
        '@publicLang': path.resolve('./public/storage/lang'),
    })
    .options({
        manifest: false,
    })
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
    })
    .sourceMaps(false, 'source-map')
    .version()
