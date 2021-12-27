<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-discount-modal">
        <div class="modal-dialog">
            <form @submit.prevent="saveDiscount()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, редагування знижки</h5>
                    <button type="button" class="btn-close" @click.prevent="cancelDiscount()"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="discountData.title" name="discount_title" label="Назва"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model.number="discountData.value" name="discount_value" label="Сумма"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelDiscount()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>

