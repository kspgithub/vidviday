const MediaLibrary = function (selector){
    const wrapper = typeof selector === 'string' ? document.querySelector(selector) : selector;
    const uploadUrl = wrapper.dataset.mediaUpload;
    const destroyUrl = wrapper.dataset.mediaDestroy;
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

    const deleteMedia = (evt)=>{
        evt.preventDefault();
        const btnEl = evt.currentTarget;
        const mediaEl = btnEl.parentElement;
        console.log(mediaEl.id);
        const mediaId = mediaEl.id.replace('media-item-', '');
        axios.delete(destroyUrl.replace('0', mediaId), {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(({data}) => {
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
        <a href="${media.url}" class="show-media-item" target="_blank" data-fancybox="${mediaCollection}"><i class="fas fa-eye"></i></a>`;
        wrapper.replaceChild(divEl, tmpNode);
        divEl.querySelector('.delete-media-item').addEventListener('click', (evt)=>deleteMedia(evt));
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

        const formData = new FormData();
        formData.append(mediaName, file);
        formData.append('collection', mediaCollection);
        axios.post(uploadUrl, formData, {
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
