import transletable from './transletable';

document.addEventListener('alpine:init', () => {
    Alpine.data('transletable', transletable)
})
