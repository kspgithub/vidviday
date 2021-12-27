<div x-data="{}">
    <template x-teleport="body">
        <div class="modal fade" tabindex="-1" id="crm-email-modal">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" method="post" @submit.prevent="$store.crmEmail.send()">
                    <div class="modal-header">
                        <h5 class="modal-title">Нове email повідомлення</h5>
                        <button type="button" @click.prevent="$store.crmEmail.cancel()" class="btn-close"
                                data-bs-dismiss="modal" ria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3 col-form-label">Тема</div>
                            <div class="col-md-9">
                                <input type="text" x-model="$store.crmEmail.subject" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Email</div>
                            <div class="col-md-9">
                                <input type="email" x-model="$store.crmEmail.email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Текст повідомлення</div>
                            <div class="col-md-9">
                            <textarea x-model="$store.crmEmail.message"
                                      id="crm-email-message"
                                      class="form-control"
                                      rows="10"
                            ></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати
                        </button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                            Відправити
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </template>
</div>
