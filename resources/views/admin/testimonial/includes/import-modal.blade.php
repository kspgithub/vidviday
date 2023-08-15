<div x-data='crmTestimonials()'>
    <template x-teleport="body">
        <div class="modal fade" tabindex="-1" id="testimonial-import-modal">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" method="post" @submit.prevent="importTestimonial()" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Импорт відгуков</h5>
                        <button type="button" @click.prevent="cancel()" class="btn-close"
                                data-bs-dismiss="modal" ria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 align-items-center">
                            <x-forms.files-group x-model="file" name="file" label="Файл"
                            label-col="col-md-3" input-col="col-md-9" @change="handleFileChange" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                            Відправити
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </template>
</div>
