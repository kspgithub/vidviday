import translatable from './translatable';
import publishable from './publishable';
import tiny from './tiny';

document.addEventListener('alpine:init', () => {
    Alpine.data('translatable', translatable);
    Alpine.data('publishable', publishable);
    Alpine.data('tiny', tiny);
})
