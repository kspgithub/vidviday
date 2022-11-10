import express from 'express'
import bodyParser from 'body-parser'
import { renderToString } from 'vue/server-renderer'
import {createSSRApp, h} from 'vue'
import { resolveComponent } from "./components";
import { defineAsyncComponent } from 'vue'

const app = express()

app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
    extended: true
}));

app.post('/render', async (req, res) => {
    // const html = '<div>ssR</div>'

    const componentName = req.body.component || 'test-component'
    const component = resolveComponent(componentName)
    const props = req.body.props || {}
    console.log('Got body:', req.body);
    console.log('component:', component);

    const app = createSSRApp({
        render: () => h(component, props)
    })

    const html = await renderToString(app)

    res.status(200).send(html)
})

app.listen(3333)
