<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-payment-modal">
        <div class="modal-dialog">
            <form @submit.prevent="savePayment()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, редагування платежу</h5>
                    <button type="button" class="btn-close" @click.prevent="cancelPayment()"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model.number="paymentData.sum" name="payment_sum" label="Сумма"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-model="paymentData.type" name="payment_type" label="Форма оплати"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.datepicker-group x-model="paymentData.date" name="payment_date" label="Дата"
                                              label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-model="paymentData.recipient" name="payment_recipient"
                                        label="Отримувач"
                                        required label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.textarea-group x-model="paymentData.comment" name="payment_comment"
                                            label="Примітка"
                                            label-col="col-md-3" input-col="col-md-9"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelPayment()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>


