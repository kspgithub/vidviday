import {processOptions, throttle, deepEqual} from './utils'
import {nextTick} from "vue";


class VisibilityState {
    constructor(el, options, vnode) {
        this.el = el
        this.observer = null
        this.frozen = false
        this.createObserver(options, vnode)
    }

    get threshold() {
        return this.options.intersection && typeof this.options.intersection.threshold === 'number' ? this.options.intersection.threshold : 0
    }

    createObserver(options, vnode) {
        if (this.observer) {
            this.destroyObserver()
        }

        if (this.frozen) return

        this.options = processOptions(options)

        this.callback = (result, entry) => {
            this.options.callback(result, entry)
            if (result && this.options.once) {
                this.frozen = true
                this.destroyObserver()
            }
        }
        // Throttle
        if (this.callback && this.options.throttle) {
            const {leading} = this.options.throttleOptions || {}
            this.callback = throttle(this.callback, this.options.throttle, {
                leading: (state) => {
                    return leading === 'both' || (leading === 'visible' && state) || (leading === 'hidden' && !state)
                },
            })
        }

        this.oldResult = undefined

        this.observer = new IntersectionObserver(entries => {
            let entry = entries[0]

            if (entries.length > 1) {
                const intersectingEntry = entries.find(e => e.isIntersecting)
                if (intersectingEntry) {
                    entry = intersectingEntry
                }
            }

            if (this.callback) {
                // Use isIntersecting if possible because browsers can report isIntersecting as true, but intersectionRatio as 0, when something very slowly enters the viewport.
                const result = entry.isIntersecting && entry.intersectionRatio >= this.threshold
                if (result === this.oldResult) return
                this.oldResult = result
                this.callback(result, entry)
            }
        }, this.options.intersection)

        // Wait for the element to be in document
        nextTick(() => {
            if (this.observer) {
                this.observer.observe(this.el)
            }
        })
        //vnode.context.$nextTick()
    }

    destroyObserver() {
        if (this.observer) {
            this.observer.disconnect()
            this.observer = null
        }

        // Cancel throttled call
        if (this.callback && this.callback._clear) {
            this.callback._clear()
            this.callback = null
        }
    }
}

const onMounted = (el, {value}, vnode) => {
    if (!value) return
    if (typeof IntersectionObserver === 'undefined') {
        console.warn('[vue-observe-visibility] IntersectionObserver API is not available in your browser. Please install this polyfill: https://github.com/w3c/IntersectionObserver/tree/master/polyfill')
    } else {
        const state = new VisibilityState(el, value, vnode)
        el._vue_visibilityState = state
    }
};

const onUnmounted = (el) => {
    const state = el._vue_visibilityState
    if (state) {
        state.destroyObserver()
        delete el._vue_visibilityState
    }
};

const onUpdated = (el, {value, oldValue}, vnode) => {
    if (deepEqual(value, oldValue)) return
    const state = el._vue_visibilityState
    if (!value) {
        onUnmounted(el)
        return
    }
    if (state) {
        state.createObserver(value, vnode)
    } else {
        onMounted(el, {value}, vnode)
    }
}

const plugin = {
    install: (app) => {
        app.directive('observe-visibility', directive)
    }
}

const directive = {
    mounted: onMounted,
    updated: onUpdated,
    unmounted: onUnmounted,
};

const mixin = {
    directives: {ClickOutside: directive},
};

export {
    directive,
    mixin
}

export default plugin;
