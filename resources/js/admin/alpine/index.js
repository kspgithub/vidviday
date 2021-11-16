import translatable from './translatable';
import publishable from './publishable';
import tiny from './tiny';
import singleFileUpload from './single-file-upload';
import tourPlaces from './tour-places';
import menuEditor from './menu-editor';
import menuList from './menu-list';
import menuItem from './menu-item';

document.addEventListener('alpine:init', () => {
    Alpine.data('translatable', translatable);
    Alpine.data('publishable', publishable);
    Alpine.data('tiny', tiny);
    Alpine.data('singleFileUpload', singleFileUpload);
    Alpine.data('tourPlaces', tourPlaces);
    Alpine.data('menuEditor', menuEditor);
    Alpine.data('menuList', menuList);
    Alpine.data('menuItem', menuItem);
})
