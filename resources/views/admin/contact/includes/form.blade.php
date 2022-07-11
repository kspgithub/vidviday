<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $contact->getTranslations('title'))" maxlength="100"
                                required></x-forms.text-loc-group>
        <x-forms.textarea-loc-group name="address" :label="__('Address')"
                                    :value="old('address', $contact->getTranslations('address'))"></x-forms.textarea-loc-group>
        <x-forms.textarea-loc-group name="address_comment" :label="__('Address Comment')"
                                    :value="old('address_comment', $contact->getTranslations('address_comment'))"></x-forms.textarea-loc-group>

        <x-forms.textarea-loc-group name="opening_hours" :label="__('Work Hours')"
                                    :value="old('opening_hours', $contact->getTranslations('opening_hours'))"></x-forms.textarea-loc-group>

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

        <x-forms.textarea-loc-group name="map_comment" label="Коментар на карті"
                                    :value="old('map_comment', $contact->getTranslations('map_comment'))"></x-forms.textarea-loc-group>

        <hr>
        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">Корпоративні замовлення</div>
            <div class="col-md-10" x-data='contactManagers({
    options: @json($managerOptions),
    items: @json($contact->managers_corporate ?? [])
})'>
                <div style="width: 300px">
                    <ul class="list-group" :class="{'mb-3': managers.length}" x-ref="sortableRef">
                        <template x-for="(manager, idx) in managers" :key="'m'+manager.value">
                            <li class="list-group-item d-flex align-items-center" :data-id="manager.value">
                                <i class="handler cursor-move fa fa-bars me-3"></i>
                                <span x-text="manager.text"></span>
                                <a href="#" class="ms-auto text-danger" @click.prevent="remove(manager.value)"><i
                                        class="fa fa-times"></i></a>
                            </li>
                        </template>

                    </ul>

                    <template x-for="(item, idx) in items">
                        <input type="hidden" :name="'managers_corporate['+idx+']'" :value="item">
                    </template>

                    <div class="d-flex align-items-center">
                        <select class="form-control me-3" x-model.number="managerId">
                            <option value="0">Оберіть менеджера</option>
                            <template x-for="option in options" :key="'o'+option.value">
                                <option :value="option.value" x-text="option.text"></option>
                            </template>
                        </select>
                        <button class="btn btn-primary" @click.prevent="add()" :disabled="!managerId">Додати</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">Співпраця з туристичними агенціями</div>
            <div class="col-md-10" x-data='contactManagers({
    options: @json($managerOptions),
    items: @json($contact->managers_agency ?? [])
})'>
                <div style="width: 300px">
                    <ul class="list-group" :class="{'mb-3': managers.length}" x-ref="sortableRef">
                        <template x-for="(manager, idx) in managers" :key="'m'+manager.value">
                            <li class="list-group-item d-flex align-items-center" :data-id="manager.value">
                                <i class="handler cursor-move fa fa-bars me-3"></i>
                                <span x-text="manager.text"></span>
                                <a href="#" class="ms-auto text-danger" @click.prevent="remove(manager.value)"><i
                                        class="fa fa-times"></i></a>
                            </li>
                        </template>

                    </ul>

                    <template x-for="(item, idx) in items">
                        <input type="hidden" :name="'managers_agency['+idx+']'" :value="item">
                    </template>

                    <div class="d-flex align-items-center">
                        <select class="form-control me-3" x-model.number="managerId">
                            <option value="0">Оберіть менеджера</option>
                            <template x-for="option in options" :key="'o'+option.value">
                                <option :value="option.value" x-text="option.text"></option>
                            </template>
                        </select>
                        <button class="btn btn-primary" @click.prevent="add()" :disabled="!managerId">Додати</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
