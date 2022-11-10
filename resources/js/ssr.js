import express from 'express'
import bodyParser from 'body-parser'
import { renderToString } from 'vue/server-renderer'
import {createSSRApp, h} from 'vue'
import { resolveComponent } from "./components";

const app = express()

app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
    extended: true
}));

app.post('/render', async (req, res) => {
    try {
        const component = resolveComponent(req.body.component)
        const props = req.body.props || {}

        const app = createSSRApp({
            render: () => h(component, props)
        })

        const html = await renderToString(app)

        res.status(200).send(html)
    } catch (e) {
        res.status(404).send(`Component ${req.body.component} not found.`)
    }

})

app.listen(3333)
