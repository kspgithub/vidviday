<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-agency-modal">
        <div class="modal-dialog">
            <form @submit.prevent="save()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, Турфірма (від кого турист)</h5>
                    <button type="button" class="btn-close" @click.prevent="cancel()"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="agency.title" name="title" label="Назва"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agency.affiliate" name="affiliate" label="Філія"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agency.manager_name" name="manager_name" label="Менеджер"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agency.manager_phone" name="manager_phone" label="Телефон менеджера"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="agency.manager_email" name="manager_email" label="Email менеджера"
                                        label-col="col-md-3" input-col="col-md-9" type="email"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancel()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>
