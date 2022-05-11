<div>
    <x-bootstrap.card>
        <x-slot name="body">
            <h2 class="mb-2">@lang('Tour Plan')</h2>
            <div style="max-width: 768px">
                @php $planTranslations = $tour->plan->getTranslations('text'); @endphp
                @foreach(siteLocales() as $locale)
                    <x-forms.editor-group x-model="plan.text.{{$locale}}"
                                          :value="$planTranslations[$locale] ?? null"
                                          name="plan[text][{{$locale}}]"
                                          id="plan_text_{{ $locale }}"
                                          label="Text {{strtoupper($locale)}}"
                                          x-bind:required="locales.indexOf('{{$locale}}') > -1"
                                          @change="console.log($event)"
                        {{--                                          :required="in_array($locale,$tour->locales) ? 'required' : ''"--}}
                    ></x-forms.editor-group>
                @endforeach
            </div>
        </x-slot>
    </x-bootstrap.card>
</div>
