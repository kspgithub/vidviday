import axios from "axios";

export default () => ({
    file: null,
    handleFileChange(event) {
        this.file = event.target.files[0];
    },
    get modal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('testimonial-import-modal'));
    },
    importShow() {
        this.modal.show();
    },
    cancel() {
        this.modal.hide();
    },
    importTestimonial() {
        let formData = new FormData();
        formData.append('file', this.file);

            axios.post(`/admin/testimonials/import`, formData, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
            })
            .then(({data: response}) => {
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    }
});
