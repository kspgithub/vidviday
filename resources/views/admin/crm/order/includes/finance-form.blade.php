<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Фінансова інформація</h3>
            <div>
                <a href="#" class="btn btn-sm btn-outline-success" @click.prevent="calcSum()">Розрахувати суму
                    замовлення</a>
            </div>
        </div>
        <x-forms.select-group label="Валюта" name="currency" x-model="order.currency" :options="$currencies"/>

        <x-forms.text-group label="Сума замовлення" name="price" x-model.number="order.price" required
                            help="(повна вартість, без знижок та комісій)"/>


        <x-forms.text-group label="Комісія агента" name="commission" x-model.number="order.commission" required/>
        <x-forms.text-group label="Сума знижки" name="discount" x-model.number="discountAmount" readonly/>
        <div class="row mb-3">
            <div class="col-md-2">Знижки</div>
            <div class="col-md-10">
                <template x-for="(discount, idx) in discounts" :key="'dscnt-'+idx">
                    <div class="d-flex align-items-center mb-3">
                        <input type="hidden" :name="`discounts[${idx}][title]`" x-bind:value="discount.title">
                        <input type="hidden" :name="`discounts[${idx}][value]`" x-bind:value="discount.value">
                        <input type="hidden" :name="`discounts[${idx}][places]`" x-bind:value="discount.places">
                        <span x-text="discount.title"></span>
                        <span class="mx-1">-</span>
                        <b>
                            <span x-text="discount.places || 1"></span>x<span x-text="discount.value || 1"></span>
                        </b>
                        <b x-text="order.currency || 'UAH'"></b>
                        <a href="#" class="btn btn-outline-success btn-sm ms-4" @click.prevent="editDiscount(idx)">
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm ms-3" @click.prevent="deleteDiscount(idx)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </template>

                <a href="#" class="btn btn-outline-success btn-sm" @click.prevent="editDiscount()">
                    <i class="fa fa-plus"></i> Додати знижку
                </a>
            </div>
        </div>

        <x-forms.text-group label="Сума до сплати" name="total_price" x-model.number="totalPrice" readonly/>

        <x-forms.select-group label="Тип оплати" name="payment_type" x-model="order.payment_type"
                              :options="$paymentTypes"></x-forms.select-group>

        <x-forms.select-group label="Статус оплати" name="payment_status" x-model="order.payment_status"
                              :options="$paymentStatuses"></x-forms.select-group>

        @include('admin.crm.order.includes.discount-modal')
    </div>

</div>

