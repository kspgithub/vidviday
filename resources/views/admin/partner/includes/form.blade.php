<div class="card">
    <div class="card-body">
        <x-forms.text-group name="title" label="Назва" :value="$partner->title" required/>
        <x-forms.text-group name="domain" label="Домен" :value="$partner->domain" required/>
        <x-forms.tag-group name="tours[]" :label="__('Tours')" :value="$partner->tours ?? []" :options="$tours"/>
        <x-forms.switch-group name="config[check_domain]" label="Перевіряти домен"
                              :active="$partner->config['check_domain'] ?? true"/>
        @if(!empty($partner->token))
            <x-forms.text-group name="token" label="Токен авторизації" required :value="$partner->token" readonly/>
        @endif
        <x-forms.switch-group name="token_generate" label="Згенерувати новий токен" :active="!$partner->token"
                              :readonly="!$partner->token"/>

        <x-forms.radio-group name="status" label="Статус" :value="$partner->status" required
                             :options="[['text'=>'Активний', 'value'=>'active'], ['text'=>'Заблокований', 'value'=>'blocked']]"/>
    </div>
</div>
