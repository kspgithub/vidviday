const MediaLibrary = function (selector){
    const wrapper = typeof selector === 'string' ? document.querySelector(selector) : selector;
    const storeUrl = wrapper.dataset.mediaStore || '#';
    const destroyUrl = wrapper.dataset.mediaDestroy || '#';
    const updateUrl = wrapper.dataset.mediaUpdate || '#';
    const mediaCollection = wrapper.dataset.mediaCollection || 'default';
    const mediaName = wrapper.dataset.mediaName || 'media_file';
    const fileElement = wrapper.querySelector('input[type="file"]');
    const addMediaBtn = wrapper.querySelector('.add-media');

    fileElement.addEventListener('change', (evt)=>{
        const files = evt.target.files;
        if(files.length > 0){
            files.forEach( file => {
                uploadMedia(file);
            })
        }
    })

    wrapper.querySelectorAll('.delete-media-item').forEach(el=> {
        el.addEventListener('click', (evt)=>deleteMedia(evt));
    })

    wrapper.querySelectorAll('.edit-media-title').forEach(el=> {
        el.addEventListener('blur', (evt)=>updateMediaTitle(evt));
    })

    const updateMediaTitle = (evt) => {
        const input = evt.currentTarget;
        if(updateUrl === '#') return;
        const mediaEl = input.parentElement;
        const mediaId = mediaEl.id.replace('media-item-', '');
        const title = input.value;
        axios.patch(updateUrl.replace('0', mediaId), {
            title: title,
        }).then(({data}) => {
            console.log(data);
        }).catch((error)=>{
            console.log(error);
            mediaEl.classList.add('error');
            mediaEl.innerHTML += `<span class="error">Update Error</span>`;
        })

    }

    const deleteMedia = (evt)=>{
        evt.preventDefault();
        if(destroyUrl === '#') return;
        const btnEl = evt.currentTarget;
        const mediaEl = btnEl.parentElement;
        const mediaId = mediaEl.id.replace('media-item-', '');
        axios.delete(destroyUrl.replace('0', mediaId)).then(({data}) => {
            if(data.result === 'success'){
                mediaEl.remove();
            }
        }).catch((error)=>{
            console.log(error);
            mediaEl.classList.add('error');
            mediaEl.innerHTML += `<span class="error">Delete Error</span>`;
        })
    }

    const addMedia = (media, tmpNode) => {
        const divEl = document.createElement('div');
        divEl.classList.add('media-item', 'img-thumbnail');
        divEl.id = 'media-item-' + media.id;
        divEl.innerHTML = `<img src="${media.thumb}" alt=""><a href="#" class="delete-media-item"><i class="fas fa-times"></i></a>
        <a href="${media.url}" class="show-media-item" target="_blank" data-fancybox="${mediaCollection}"><i class="fas fa-eye"></i></a>
        <input class="edit-media-title" value="Change image title" />`;
        wrapper.replaceChild(divEl, tmpNode);
        divEl.querySelector('.delete-media-item').addEventListener('click', (evt)=>deleteMedia(evt));
        divEl.querySelector('.edit-media-title').addEventListener('blur', (evt)=>updateMediaTitle(evt));
    }

    const uploadMedia = (file) =>{
        const reader = new FileReader();
        const divEl = document.createElement('div');
        divEl.classList.add('media-item', 'media-tmp', 'img-thumbnail');

        reader.onload = (pe) => {
            const src = pe.target.result;
            divEl.innerHTML = `<img src="${src}" alt=""><div class="spinner-border text-warning" role="status"></div>`;
            wrapper.insertBefore(divEl, addMediaBtn);
        }
        reader.readAsDataURL(file);

        if(storeUrl === '#') return;

        const formData = new FormData();
        formData.append(mediaName, file);
        formData.append('collection', mediaCollection);
        axios.post(storeUrl, formData, {
           headers: {
               'Content-Type': 'multipart/form-data'
           }
        }).then(({data}) => {
            if(data.result === 'success'){
                addMedia(data.media, divEl);
            }
        }).catch((error)=>{
            console.log(error);
            divEl.classList.add('error');
            divEl.querySelector('.spinner-border').remove();
            divEl.innerHTML += `<span class="error">Upload Error</span>`;
        })
    }
}


window.MediaLibrary = MediaLibrary;

document.addEventListener('DOMContentLoaded',  () =>{
    const libraries = document.querySelectorAll('[data-media-upload]');
    libraries.forEach((el)=>{
        const lib = new MediaLibrary(el);
    })
});
