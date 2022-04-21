<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інше</h3>
        </div>

        <x-forms.textarea-group x-model="order.duty_comment" name="duty_comment" label="Додатково" rows="5"
                                :readonly="!current_user()->can('order-admin-comments', $order)"
        />
        <x-forms.textarea-group x-model="order.admin_comment" name="admin_comment" label="Примітки менеджера" rows="5"
                                :readonly="!current_user()->can('order-admin-comments', $order)"
        />

        <x-forms.text-group x-model.number="utmData.customer_source" name="utm_data[customer_source]"
                            label="Джерело клієнта"/>

        <x-forms.text-group x-model.number="utmData.customer_device" name="utm_data[customer_device]"
                            label="Засіб клієнта"/>
    </div>

</div>


