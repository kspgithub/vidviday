<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про замовника</h3>
        </div>
        <x-forms.text-group label="Прізвище" name="last_name" x-model="order.last_name" required/>
        <x-forms.text-group label="Ім'я" name="first_name" x-model="order.first_name" required/>
        <x-forms.text-group :label="__('forms.phone')" name="phone" x-model="order.phone" type="tel" required/>
        <x-forms.text-group label="Email" name="email" x-model="order.email" type="email"/>
        <x-forms.text-group :label="__('forms.viber')" name="viber" x-model="order.viber"/>
        <x-forms.text-group label="Компанія" name="company" x-model="order.company"/>
    </div>

</div>
