import axios from "axios"
import express from 'express'
import { renderToString } from 'vue/server-renderer'

globalThis.axios = axios

import { createVueApp } from "./vue-app"


const port = process.env.MIX_SSR_PORT || 3000

const app = express()

app.post('/render', async (req, res) => {
    try {
        const { app } = createVueApp({ssrContext: req});

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
