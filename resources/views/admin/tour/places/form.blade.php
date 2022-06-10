<x-bootstrap.card>
    <x-slot name="body">
        <h2 class="mb-2">@lang('Tour places')</h2>
        <div>
            <form method="post" wire:submit.prevent="saveItem()">

                <x-forms.select-group wire:model="type_id" name="type_id" :label="__('Type')"
                                      :options="$types">
                    <option value="0">Не вибрано</option>
                </x-forms.select-group>

                @if($type_id == App\Models\TourPlace::TYPE_TEMPLATE)
                    {{$region_id}}
                    <x-forms.select-group wire:model="region_id" name="region_id" :label="__('Region')"
                                          :options="$regions">
                        <option value="0">Не вибрано</option>
                    </x-forms.select-group>

                    {{$district_id}}
                    <x-forms.select-group wire:model="district_id" name="district_id" :label="__('District')"
                                          :select2="true"
                                          :allowClear="true"
                                          autocomplete="/api/location/districts"
                                          :placeholder="__('Не вибрано')"
                                          :filters="['region_id' => $region_id, 'district_id' => $district_id, 'place_id' => $place_id]"
                                          :options="$districts" />

                    {{$place_id}}
                    <x-forms.select-group wire:model="place_id" name="place_id" :label="__('Template')"
                                          :select2="true"
                                          :allowClear="true"
                                          autocomplete="/api/places/select-box"
                                          :placeholder="__('Не вибрано')"
                                          :filters="['region_id' => $region_id, 'district_id' => $district_id, 'place_id' => $place_id]"
                                          :options="$places" />

                    @if($place_id && $place)
                        <div x-data='translatable({expanded:  true})'>

                            <x-forms.text-loc-group name="title" :label="__('Title')"
                                                    :value="old('title', $place->getTranslations('title'))"/>

                            <div class="row mb-3">
                                <div class="col-md-2">@lang('Text')</div>
                                <div class="col-md-10">
                                    @foreach(siteLocales() as $locale)
                                        <div class="mb-3 row">
                                            <div class="col-auto">{{$locale}}</div>
                                            <div class="col">
                                                <div class="border p-2">{!! $place->getTranslation('text', $locale) !!}</div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                @if($type_id == App\Models\TourPlace::TYPE_CUSTOM)
                    <x-forms.select-group wire:model="region_id" name="region_id" :label="__('Region')"
                                          :options="$regions">
                        <option value="0">Не вибрано</option>
                    </x-forms.select-group>

                    <x-forms.select-group wire:model="district_id" name="district_id" :label="__('District')"
                                          :options="$districts">
                        <option value="0">Не вибрано</option>
                    </x-forms.select-group>
                @endif


                <button type="submit" class="btn btn-primary me-3"
                        wire:loading.class="disabled">@lang('Save')</button>
                <button type="button" wire:click.prevent="cancelEdit()"
                        class="btn btn-outline-secondary">@lang('Cancel')</button>
            </form>
        </div>
    </x-slot>
</x-bootstrap.card>
