globalThis.document = {
    head: {
        addEventListener: () => ({}),
        appendChild: () => ({timeStamp: null}),
    },
    body: {
        addEventListener: () => ({}),
        appendChild: () => ({timeStamp: null}),
    },
    documentElement: {
        lang: 'uk',
    },
    createElement: () => ({
        addEventListener: () => ({}),
        appendChild: () => ({}),
    }),
    createEvent: () => ({timeStamp: null}),
    addEventListener: () => ({}),
    dispatchEvent: () => ({}),
    createTextNode: () => ({}),
}
globalThis.navigator = {userAgent: 'nodejs'}
globalThis.window = {
    navigator,
    bootstrap: {},
    addEventListener: () => ({}),
    dispatchEvent: () => ({}),
    localStorage: {
        getItem(){},
        setItem(){},
        removeItem(){},
    }
}
globalThis.self = window
globalThis.axios = require('axios')

globalThis.require = async function (path) {
    return await import(path)
}
