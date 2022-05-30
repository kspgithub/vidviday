<div x-data='tourTickets({
    locales: @json(siteLocales()),
    ticket: @json($model->ticket),
    model: @json($model),
    regions: @json($regions),
    tickets: @json($tickets),
})'>
    <x-forms.translation-switch/>

    <x-forms.select-group :value="old('region_id', $model->region_id)"
                          select2="true"
                          name="region_id"
                          x-model.number="model.region_id"
                          :label="__('Region')">
        <option value="0">Оберіть область</option>
        <template x-for="option in regions">
            <option x-bind:value="option.value" x-bind:selected="option.value == model.region_id"
                    x-html="option.text"></option>
        </template>
    </x-forms.select-group>

    <div class="form-group row mb-3">
        <div class="col-md-2 col-form-label">@lang('Ticket')</div>
        <div class="col-md-10">
            <div>
                <select name="ticket_id" id="ticket_id"
                        class="form-control"
                        x-ref="input"
                        x-model.number="model.ticket_id"
                >
                    <option value="0">Оберіть квиток</option>
                    <template x-for="option in tickets">
                        <option x-bind:value="option.value" x-bind:selected="option.value == model.ticket_id"
                                x-html="option.text"></option>
                    </template>
                </select>
            </div>
        </div>
    </div>

    <template x-if="model.ticket_id === 0 || !ticket">
        <div>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $model->getTranslations('title'))"/>
            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $model->getTranslations('text'))"/>
        </div>
    </template>
    <template x-if="model.ticket_id > 0 && ticket">
        <div>
            <x-forms.text-loc-group name="title" :label="__('title')"
                                    :value="old('title', $model->getTranslations('title'))"/>
            <div class="row mb-3">
                <div class="col-md-2">@lang('Text')</div>
                <div class="col-md-10">
                    <template x-for="loc in locales">
                        <div class="mb-3 row">
                            <div x-text="loc.toUpperCase()" class="col-auto"></div>
                            <div class="col">
                                <div x-html="ticket?.text[loc] || ''" class="border p-2"></div>
                            </div>

                        </div>

                    </template>

                </div>
            </div>
        </div>

    </template>


</div>
