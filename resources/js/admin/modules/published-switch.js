
const PublishedSwitch = function (wrapper){
    const checkboxEl = wrapper.querySelector('.form-check-input');
    const updateUrl = wrapper.dataset.url;

    checkboxEl.addEventListener('change', async (evt)=> {
        const checked = evt.target.checked;
        checkboxEl.disabled = true;
        await axios.patch(updateUrl, {published: checked ? 1 : 0});
        checkboxEl.disabled = false;
        if(checked){
            toast.success('Запис опубліковано');
        }else{
            toast.success('Запис знятий з публікації');
        }
    })
}


document.addEventListener('DOMContentLoaded',  () =>{
    const uploaders = document.querySelectorAll('.published-switch');
    uploaders.forEach((el)=>{
        const switchItem = new PublishedSwitch(el);
    })
});
