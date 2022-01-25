<template x-teleport="body">

    <div class="modal fade" tabindex="-1" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="selectedOrder.id"></span></h5>
                    <button type="button" class="btn-close" @click.prevent="cancelEdit()"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="selectedOrder.first_name" name="first_name" label="Ім'я"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="selectedOrder.last_name" name="last_name" label="Прізвище"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="tel" x-model="selectedOrder.phone" name="phone" :label="__('forms.phone')"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="email" x-model="selectedOrder.email" name="email" label="Email"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="selectedOrder.viber" name="viber" :label="__('forms.viber')"
                                        label-col="col-md-3" input-col="col-md-9"/>


                    <h5 class="mt-3">Турфірма (від кого турист)</h5>
                    <x-forms.text-group x-model="agencyData.title" name="title" label="Назва"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agencyData.affiliate" name="affiliate" label="Філія"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agencyData.manager_name" name="manager_name" label="Менеджер"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agencyData.manager_phone" name="manager_phone" label="Телефон"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agencyData.manager_email" name="manager_email" label="Email"
                                        label-col="col-md-3" input-col="col-md-9" type="email"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            @click.prevent="cancelEdit()">Скасувати
                    </button>
                    <button type="button" class="btn btn-primary"
                            data-bs-dismiss="modal"
                            @click.prevent="saveOrder()">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
