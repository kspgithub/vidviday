import transletable from './transletable';
import tiny from './tiny';

document.addEventListener('alpine:init', () => {
    Alpine.data('transletable', transletable);
    Alpine.data('tiny', tiny);
})
