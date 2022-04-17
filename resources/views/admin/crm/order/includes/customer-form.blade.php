<div class="card">
    <div class="card-body" x-data="{open: true}">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про замовника</h3>
            <div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" x-model="open" id="customer-open"/>
                    <label class="form-check-label" for="customer-open"></label>
                </div>
            </div>
        </div>
        <div x-show="open" x-transition>
            <x-forms.text-group label="Прізвище" name="last_name" x-model="order.last_name" required/>
            <x-forms.text-group label="Ім'я" name="first_name" x-model="order.first_name" required/>
            <x-forms.text-group label="По батькові" name="middle_name" x-model="order.middle_name"/>
            <x-forms.text-group label="Дата народження" name="birthday" x-model="order.birthday" x-datepicker/>
            <x-forms.text-group label="Телефон" name="phone" x-model="order.phone" type="tel"
                                placeholder="+38 (___) ___-__-__" x-mask="+38 (999) 999-99-99" required/>
            <x-forms.text-group label="Email" name="email" x-model="order.email" type="email"/>
            <x-forms.text-group label="Viber" name="viber" x-model="order.viber"/>
            <x-forms.text-group label="Компанія" name="company" x-model="order.company"/>
        </div>
    </div>

</div>
