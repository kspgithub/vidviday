<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-discount-modal">
        <div class="modal-dialog">
            <form @submit.prevent="saveDiscount()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, редагування знижки</h5>
                    <button type="button" class="btn-close" @click.prevent="cancelDiscount()"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-3">Оберіть знижку</div>
                        <div class="col-md-9">
                            <select name="discount_id" class="form-control" x-model.number="discountData.id"
                                    @change="discountChanged()">
                                <option value="0">Своя</option>
                                <template x-for="item  in tourDiscounts">
                                    <option :value="item.id" x-text="item.admin_title || item.title.uk"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <x-forms.text-group x-bind:readonly="discountData.id > 0"
                                        x-model="discountData.title" name="discount_title"
                                        label="Назва" required
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-bind:readonly="discountData.id > 0"
                                        x-model.number="discountData.value" name="discount_value"
                                        label="Сумма за особу" required
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <x-forms.text-group x-model.number="discountData.places" name="discount_places"
                                        label="Кількість осіб" required
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

