import translatable from './translatable';
import publishable from './publishable';
import tiny from './tiny';
import singleFileUpload from './single-file-upload';

document.addEventListener('alpine:init', () => {
    Alpine.data('translatable', translatable);
    Alpine.data('publishable', publishable);
    Alpine.data('tiny', tiny);
    Alpine.data('singleFileUpload', singleFileUpload);
})
