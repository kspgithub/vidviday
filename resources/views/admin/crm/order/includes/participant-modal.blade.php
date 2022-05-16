<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-participant-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, учасник туру</h5>
                    <button type="button" class="btn-close" @click.prevent="cancelEdit()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="data.first_name" name="first_name" label="Ім'я"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.last_name" name="last_name" label="Прізвище"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.middle_name" name="middle_name" label="По батькові"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.datepicker-group x-model="data.birthday" name="birthday" label="Дата народження"
                                              label-col="col-md-3" input-col="col-md-9"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelEdit()">Скасувати</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            @click.prevent="saveParticipant()">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
