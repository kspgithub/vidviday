<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Турфірма (від кого турист)</h3>
        </div>
        <x-forms.text-group x-model="agency.title" name="agency_data[title]" label="Назва"/>
        <x-forms.text-group x-model="agency.affiliate" name="agency_data[affiliate]" label="Філія"/>
        <x-forms.text-group x-model="agency.manager_name" name="agency_data[manager_name]" label="Менеджер"/>
        <x-forms.text-group x-model="agency.manager_phone" name="agency_data[manager_phone]" label="Телефон менеджера"/>
        <x-forms.text-group x-model="agency.manager_email" name="agency_data[manager_email]" label="Email менеджера"
                            type="email"/>
    </div>

</div>

