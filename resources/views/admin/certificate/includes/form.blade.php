<div x-data='@json($certificate)'>
    <h3>Замовник</h3>
    <x-forms.text-group name="first_name" :label="__('First Name')"
                        :value="old('first_name', $certificate->first_name)"
                        required></x-forms.text-group>

    <x-forms.text-group name="last_name" :label="__('Last Name')"
                        :value="old('last_name', $certificate->last_name)"
                        required></x-forms.text-group>

    <x-forms.text-group name="email" :label="__('Email')"
                        type="email"
                        :value="old('email', $certificate->email)"
                        required></x-forms.text-group>

    <x-forms.text-group name="phone" :label="__('Phone')"
                        type="tel"
                        :value="old('phone', $certificate->phone)"
                        required></x-forms.text-group>

    <h3 class="mt-4">Отримувач</h3>
    <x-forms.text-group name="first_name_recipient" :label="__('First Name')"
                        :value="old('first_name_recipient', $certificate->first_name_recipient)"
                        required></x-forms.text-group>

    <x-forms.text-group name="last_name_recipient" :label="__('Last Name')"
                        :value="old('last_name_recipient', $certificate->last_name_recipient)"
                        required></x-forms.text-group>

    <h3 class="mt-4">Інформація</h3>
    <x-forms.radio-group name="type" :label="__('Type')" :value="old('type', $certificate->type)"
                         x-model="type"
                         :options="$types"
                         :inline="true"/>

    <div x-show="type === 'tour'">
        <x-forms.tour-autocomplite name="tour_id" :label="__('Tour')"
                                   x-bind:required="type === 'tour'"
                                   :value="$certificate->tour_id"
                                   :tour="$certificate->tour"/>

        <x-forms.text-group name="places" :label="__('Places')"
                            :value="old('places', $certificate->places)"
                            type="number"
                            x-bind:required="type === 'tour'"
        ></x-forms.text-group>
    </div>


    <div x-show="type === 'sum'">
        <x-forms.text-group name="sum" :label="__('Sum')"
                            x-bind:required="type === 'sum'"
                            :value="old('sum', $certificate->sum)" type="number"
                            required></x-forms.text-group>
    </div>


    <x-forms.radio-group name="format" :label="__('Format')" :value="old('format', $certificate->format)"
                         :inline="true"
                         x-model="format"
                         :options="$formats"/>
    <x-forms.radio-group name="design" :label="__('Design')" :value="old('design', $certificate->design)"
                         :inline="true"
                         x-model="design"
                         :options="$designs"/>

    <x-forms.switch-group name="packing" x-model="packing" :label="__('Packing')"
                          x-model="packing"
                          :active="$certificate->packing"></x-forms.switch-group>
    <div x-show="packing">
        <x-forms.radio-group name="packing_type" :label="__('Packing Type')"
                             :value="old('packing_type', $certificate->packing_type)"
                             :inline="true"
                             x-bind:required="packing"
                             :options="$packing"/>
    </div>
    <x-forms.text-group name="price" :label="__('Price')"
                        :value="old('price', $certificate->price)" type="number"
                        required></x-forms.text-group>

    <x-forms.radio-group name="payment_type" :label="__('Payment Type')"
                         :value="old('payment_type', $certificate->payment_type)"
                         x-model="payment_type"
                         :options="$paymentTypes"/>

    <x-forms.textarea-group name="comment" :label="__('Comment')"
                        :value="old('comment', $certificate->comment)"
                        required></x-forms.textarea-group>
</div>

