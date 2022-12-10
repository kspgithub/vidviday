import express from 'express'
import { renderToString } from 'vue/server-renderer'
import { createVueApp } from "./vue-app"

const port = process.env.MIX_SSR_PORT
const server = express.server()

server.listen(3000, () => {
    console.log('Listening port ' + port)
})
