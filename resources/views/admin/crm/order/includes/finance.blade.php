<div class="card" x-data='crmOrderFinance(@json($order))'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Фінансова інформація</h3>
            <div>

            </div>
        </div>

        <table class="table  table-bordered">
            <tbody>
            <tr class="table-light border-top">
                <th style="width: 300px">Сума до оплати</th>
                <td>
                    <b x-text="totalPrice"></b>
                    <b x-text="order.currency"></b>
                </td>
            </tr>
            <tr>
                <th style="width: 300px">Сумма замовлення без урахування знижок та комісій</th>
                <td>

                    <template x-if="!editSumMode">
                        <div>
                            <b x-text="orderPrice"></b>
                            <b x-text="order.currency"></b>
                            <a href="#" @click.prevent="editSum()" class="ms-3 text-success">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                    </template>
                    <template x-if="editSumMode">
                        <form @submit.prevent="saveSum()">
                            <div class="d-flex align-items-center">
                                <input type="number" id="orderPrice" x-model.number="orderPrice"
                                       class="form-control form-control-sm me-3" required>
                                <button type="submit" class="btn btn-sm btn-outline-success me-3">
                                    <i class="fa fa-save"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary me-3"
                                        @click.prevent="cancelSum()">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </div>

                        </form>

                    </template>
                </td>
            </tr>
            <tr>
                <th style="width: 300px">Турагентська комісія</th>
                <td>
                    <template x-if="!editComMode">
                        <div>

                            <b x-text="orderCommission"></b>
                            <b x-text="order.currency"></b>
                            <a href="#" class="ms-3 text-success" @click.prevent="editCom()">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                    </template>
                    <template x-if="editComMode">
                        <form @submit.prevent="saveCom()">
                            <div class="d-flex align-items-center">
                                <input type="number" id="orderCommission" x-model.number="orderCommission"
                                       class="form-control form-control-sm me-3" required>
                                <button type="submit" class="btn btn-sm btn-outline-success me-3">
                                    <i class="fa fa-save"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary me-3"
                                        @click.prevent="cancelCom()">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </div>

                        </form>

                    </template>


                </td>
            </tr>
            <tr class="table-light">
                <th style="width: 300px">Сума знижки загальна</th>
                <td>
                    <b x-text="totalDiscount"></b>
                    <b x-text="order.currency"></b>
                </td>
            </tr>
            <template x-for="(discount, idx) in discounts" :key="'dscnt-'+idx">
                <tr>
                    <td><span x-text="discount.title"></span></td>
                    <td>
                        <span x-text="discount.value"></span>
                        <span x-text="order.currency"></span>

                        <a href="#" class="text-success ms-4" @click.prevent="editDiscount(idx)">
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="#" class="text-danger ms-3" @click.prevent="deleteDiscount(idx)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </template>
            <tr class="table-light">
                <th style="width: 300px">Сплачено</th>
                <td>
                    <b x-text="totalPayed"></b>
                    <b x-text="order.currency"></b>
                </td>
            </tr>
            <template x-for="(payment, idx) in payments" :key="'pmnt-'+idx">
                <tr>
                    <td><span x-text="'Платіж №'+(idx + 1)"></span></td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <div class="me-4">
                                <div class="me-3">
                                    <b class="me-1">Сумма:</b>
                                    <span x-text="payment.sum"></span>
                                    <span x-text="order.currency"></span>
                                </div>
                                <div class="me-3">
                                    <b class="me-1">Дата:</b>
                                    <span x-text="payment.date"></span>
                                </div>
                                <div class="me-3">
                                    <b class="me-1">Форма оплати:</b>
                                    <span x-text="payment.type"></span>
                                </div>
                                <div class="me-3">
                                    <b class="me-1">Отримувач:</b>
                                    <span x-text="payment.recipient"></span>
                                </div>
                                <div x-show="payment.comment">
                                    <b class="me-1">Примітка:</b>
                                    <span x-text="payment.comment"></span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <a href="#" class="text-success me-3" @click.prevent="editPayment(idx)">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="#" class="text-danger" @click.prevent="deletePayment(idx)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </template>
            <tr class="table-light">
                <th style="width: 300px">Дозбирати</th>
                <td>
                    <b x-text="pickUpPayment"></b>
                    <b x-text="order.currency"></b>
                </td>
            </tr>
            </tbody>
        </table>

        <a href="#" class="btn btn-sm btn-outline-primary me-3 mb-3" @click.prevent="editDiscount()">
            <i class="fa fa-plus"></i> Додати знижку
        </a>
        <a href="#" class="btn btn-sm btn-outline-success me-3 mb-3" @click.prevent="editPayment()"><i
                class="fa fa-plus"></i> Додати платіж</a>

        @include('admin.crm.order.includes.discount-modal')
        @include('admin.crm.order.includes.payment-modal')
    </div>
</div>
