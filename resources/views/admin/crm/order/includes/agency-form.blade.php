<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center ">
            <h3 class="fw-bold">Турфірма (від кого турист)</h3>
            <div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" x-model="order.is_tour_agent" id="is_tour_agent"/>
                    <label class="form-check-label" for="is_tour_agent">Замовлення від турагента</label>
                </div>
                <input type="hidden" name="is_tour_agent" :value="order.is_tour_agent ? 1 : 0">
            </div>
        </div>
        <div x-cloak x-show="order.is_tour_agent" x-transition class="mt-3">
            <x-forms.text-group x-model="agency.title" name="agency_data[title]" label="Назва"/>
            <x-forms.text-group x-model="agency.affiliate" name="agency_data[affiliate]" label="Філія"/>
            <x-forms.text-group x-model="agency.manager_name" name="agency_data[manager_name]" label="Менеджер"/>
            <x-forms.text-group x-model="agency.manager_phone" name="agency_data[manager_phone]"
                                label="Телефон менеджера"/>
            <x-forms.text-group x-model="agency.manager_email" name="agency_data[manager_email]" label="Email менеджера"
                                type="email"/>
        </div>

    </div>

</div>

