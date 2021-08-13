// Глобальные компоненты


export default {
    install: (app, options) => {

        app.use(require('./click-outside').default);
        app.use(require('./only-number').default);

    }
}
