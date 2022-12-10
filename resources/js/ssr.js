require('./ssr-bootstrap')

const express = require('express')
const { renderToString } = require('vue/server-renderer')
const { createVueApp } = require('./vue-app')
const { h, compile, shallowRef} = require("vue");


const port = process.env.MIX_SSR_PORT || 3000

const app = express()

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.post('/render', async (req, res) => {
    try {

        const target = shallowRef({
            component: undefined,
            props: {},
        })

        const { app } = createVueApp({
            render: () => h(target.value.component, target.value.props)
        });

        target.value.component = app.component(req.body.component)
        target.value.props = req.body.props || {}

        const ctx = {}
        const html = await renderToString(app, ctx)

        res.status(200).set({ 'Content-Type': 'text/html' }).end(html)
    } catch (e) {
        console.error(e.stack)
        res.status(500).end(e.stack)
    }
})


app.listen(port, () => {
    console.log('Listening port ' + port)
})
