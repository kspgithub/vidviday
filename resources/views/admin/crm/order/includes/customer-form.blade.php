<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про замовника</h3>
            <div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" x-model="order.is_customer" id="customer-open" @change="order.is_tour_agent = !order.is_tour_agent"/>
                    <label class="form-check-label" for="customer-open"></label>
                </div>
            </div>
        </div>
        <div x-show="!order.is_tour_agent" x-transition>
            <x-forms.text-group label="Прізвище" name="last_name" x-model="order.last_name"
                                x-bind:required="!order.is_tour_agent"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Ім'я" name="first_name" x-model="order.first_name"
                                x-bind:required="!order.is_tour_agent"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="По батькові" name="middle_name" x-model="order.middle_name"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Дата народження" name="birthday" x-model="order.birthday" x-datepicker
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Телефон" name="phone" x-model="order.phone" type="tel"
                                placeholder="+38 (___) ___-__-__" x-mask="+38 (999) 999-99-99"
                                x-bind:required="!order.is_tour_agent"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Email" name="email" x-model="order.email" type="email"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Viber" name="viber" x-model="order.viber"
                                x-bind:disabled="order.is_tour_agent||false"/>
            <x-forms.text-group label="Компанія" name="company" x-model="order.company"
                                x-bind:disabled="order.is_tour_agent||false"/>
        </div>
    </div>

</div>
