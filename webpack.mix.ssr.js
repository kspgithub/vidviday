const mix = require("laravel-mix");
const path = require("path");
const webpackNodeExternals = require('webpack-node-externals')

mix
    .setResourceRoot('/assets/ssr/')
    .setPublicPath(path.normalize(`public/assets/ssr`))
    .options({
        manifest: false
    })
    .js(`resources/js/ssr.js`, `public/assets/ssr`)
    .vue({
        version: 3,
        extractStyles: true,
        options: {
            optimizeSSR: true
        }
    })
    .alias({
        '@lang': path.resolve('./resources/lang'),
        '@publicLang': path.resolve('./public/storage/lang'),
    })
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
        output: {
            chunkFilename: path.normalize(`../assets/app/js/chunks/[name].[chunkhash].js`)
        },
    })
    .version()
