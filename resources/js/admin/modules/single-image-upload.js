const SingleImageUpload = function (selector){
    const wrapper = typeof selector === 'string' ? document.querySelector(selector) : selector;
    const oldValueElement = wrapper.querySelector('.old-file');
    const fileElement = wrapper.querySelector('input[type="file"]');
    const clearElement = wrapper.querySelector('.clear-image');
    const thumbnailElement = wrapper.querySelector('.img-thumbnail');

    if(fileElement){
        fileElement.addEventListener('change', (evt)=>{
            const files = evt.target.files;
            if(files.length > 0){
                const file = files[0];
                const reader = new FileReader();
                reader.onload = (pe) => {

                    thumbnailElement.setAttribute('src', pe.target.result);
                    clearElement.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }

        })

        clearElement.addEventListener('click', (evt)=>{
            evt.preventDefault();
            thumbnailElement.setAttribute('src', '/img/no-image.png');
            oldValueElement.value = '';
            fileElement.value = '';
            clearElement.classList.add('d-none');
        });
    }
}

window.ImageUploadGroup = SingleImageUpload;

document.addEventListener('DOMContentLoaded',  () =>{
    const uploaders = document.querySelectorAll('.image-upload-group');
    uploaders.forEach((el)=>{
        const group = new SingleImageUpload(el);
    })
});
