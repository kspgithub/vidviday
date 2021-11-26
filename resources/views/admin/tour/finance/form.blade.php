<div x-data='tourFinance({
    locales: @json(siteLocales()),
    finance: @json($model->finance),
    model: @json($model),
    types: @json($types),
    finances: @json($finances),
    includeOptions: @json($includeOptions),
    excludeOptions: @json($excludeOptions),
})'>
    <x-bootstrap.card>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.select-group name="type_id"
                                  :label="__('Type')"
                                  :value="old('type_id', $model->type_id)"
                                  x-model.number="model.type_id"
                                  x-on:change="onTypeChange"
                                  required
                                  :options="$types">
                <option value="0">Не вибано</option>
            </x-forms.select-group>

            <x-forms.select-group :value="old('finance_id', $model->finance_id)"
                                  name="finance_id"
                                  x-model.number="model.finance_id"
                                  x-on:change="onFinanceChange"
                                  x-bind:disabled="model.type_id === 0"
                                  :label="__('Template')">
                <option value="0">Не вибано</option>
                <template x-for="option in financeOptions">
                    <option x-bind:value="option.value" x-bind:selected="option.value === model.finance_id"
                            x-text="option.text"></option>
                </template>
            </x-forms.select-group>

            <template x-if="model.finance_id === 0 || !finance">
                <x-forms.editor-loc-group name="text" :label="__('Text')"
                                          :value="old('text', $model->getTranslations('text'))"
                                          required/>
            </template>
            <template x-if="model.finance_id > 0 && finance">
                <div class="row mb-3">
                    <div class="col-md-2">@lang('Text')</div>
                    <div class="col-md-10">
                        <template x-for="loc in locales">
                            <div class="mb-3 row">
                                <div x-text="loc.toUpperCase()" class="col-auto"></div>
                                <div class="col">
                                    <div x-html="finance.text[loc] || ''" class="border p-2"></div>
                                </div>

                            </div>

                        </template>

                    </div>
                </div>
            </template>

        </x-slot>
    </x-bootstrap.card>

</div>
