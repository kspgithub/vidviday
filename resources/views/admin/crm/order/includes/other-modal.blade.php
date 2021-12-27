<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-other-modal">
        <div class="modal-dialog">
            <form @submit.prevent="save()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, інша інформація</h5>
                    <button type="button" class="btn-close" @click.prevent="cancel()"></button>
                </div>
                <div class="modal-body">
                    <x-forms.textarea-group x-model="comment" name="comment" label="Додатково"
                                            rows="5"
                                            label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.textarea-group x-model="admin_comment" name="admin_comment" label="Примітки менеджера"
                                            rows="5"
                                            label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-model.number="utm_data.customer_source" name="customer_source"
                                        label="Джерело клієнта"
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-model.number="utm_data.customer_device" name="customer_device"
                                        label="Засіб клієнта"
                                        label-col="col-md-3" input-col="col-md-9"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancel()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>

