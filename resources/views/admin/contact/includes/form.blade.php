<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Contact')</h3>
    </x-slot>

    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $contact->title)" maxlength="100"
                            required></x-forms.text-group>
        <x-forms.textarea-group name="address" :label="__('Address')"
                                :value="old('address', $contact->address)"></x-forms.textarea-group>
        <x-forms.textarea-group name="address_coment" :label="__('Address Comment')"
                                :value="old('address_coment', $contact->address_coment)"></x-forms.textarea-group>
        <x-forms.text-group name="email" :label="__('Email')" :value="old('email', $contact->email)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="work_phone" :label="__('Work Phone')" :value="old('work_phone', $contact->work_phone)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="phone_1" :label="__('Phone').' Kyivstar'" :value="old('phone_1', $contact->phone_1)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="phone_2" :label="__('Phone').' Lifecell'" :value="old('phone_2', $contact->phone_2)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="phone_3" :label="__('Phone').' Vodafone'" :value="old('phone_3', $contact->phone_3)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="skype" :label="__('Skype')" :value="old('skype', $contact->skype)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="viber" :label="__('Viber')" :value="old('viber', $contact->viber)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="telegram" :label="__('Telegram')" :value="old('telegram', $contact->telegram)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="whatsapp" :label="__('Whatsapp')" :value="old('whatsapp', $contact->whatsapp)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="messenger" :label="__('Messenger')" :value="old('messenger', $contact->messenger)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="lat" :label="__('Lat')" :lat="old('lat', $contact->lat)"
                            :value="old('lat', $contact->lat)"></x-forms.text-group>
        <x-forms.text-group name="lng" :label="__('Lng')" :lng="old('lng', $contact->lng)"
                            :value="old('lng', $contact->lng)"></x-forms.text-group>
    </x-slot>

</x-bootstrap.card>

