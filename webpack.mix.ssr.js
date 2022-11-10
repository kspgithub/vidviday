const mix = require("laravel-mix");
const path = require("path");
const webpackNodeExternals = require('webpack-node-externals')

mix
    .setResourceRoot(Mix.config.hmr ? path.normalize(`/`) : '/assets/ssr/')
    .setPublicPath(`public/assets/ssr`)
    .js(`resources/js/ssr.js`, `public/assets/ssr`)
    .vue({
        extractStyles: true,
        options: {
            optimizeSSR: true
        }
    })
    .alias({
        '@lang': path.resolve('./resources/lang'),
        '@publicLang': path.resolve('./public/storage/lang'),
    })
    .options({
        manifest: false,
        processCssUrls: false,
    })
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
        output: {
            chunkFilename: Mix.config.hmr ? 'js/chunks/[name].[chunkhash].js' : path.normalize(`../assets/app/js/chunks/[name].[chunkhash].js`)
        },
    })
    .version()
