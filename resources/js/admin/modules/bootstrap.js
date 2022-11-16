import * as bootstrap from "bootstrap";

// Bootstrap
// Note: If you want to make bootstrap globally available, e.g. for using `bootstrap.modal`
window.bootstrap = bootstrap;



try {
    document.addEventListener('DOMContentLoaded', function (){
        Array.from(document.querySelectorAll('.toast'))
            .forEach(node => {
                const toast = new bootstrap.Toast(node);
                toast.show();
                node.addEventListener('hidden.bs.toast', (evt) =>{
                    node.remove();
                });
            });
    });

}catch (e){
    console.log(e);
}
