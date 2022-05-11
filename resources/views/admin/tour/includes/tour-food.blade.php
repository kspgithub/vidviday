<div>
    @if(!$edit)
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Tour food')</h2>
                <table class="table table-sm mb-3">
                    <thead>
                    <tr>
                        <th class="text-nowrap">@lang('Day')</th>
                        <th class="text-nowrap">@lang('Time')</th>
                        <th class="text-nowrap">@lang('Food')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->day}}-й день</td>
                            <td class="text-nowrap">{{$item->time->title}}</td>
                            <td class="text-nowrap">{{$item->food ? $item->food->title.', '.$item->food->price.$item->food->currency : 'не вибрано'}}</td>
                            <td style="width: 150px">
                                <a href="#" wire:click.prevent="editItem({{$item->id}})" class="btn btn-success m-2"><i
                                        class="fas fa-file-alt"></i></a>
                                <a href="#deleteModal" wire:click="deleteId({{$item->id}})" data-bs-toggle="modal"
                                   class="btn btn-danger m-2"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

                <a href="#" wire:click.prevent="addItem()" class="btn btn-primary m-2">
                    @lang('Create Record')
                </a>
            </x-slot>
        </x-bootstrap.card>

        @include('livewire-tables::bootstrap-5.includes.delete-modal')
    @else
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Tour food')</h2>
                <div>
                    <form method="post" wire:submit.prevent="saveItem()">

                        @foreach($locales as  $locale)
                            <x-forms.text-group wire:model.defer="text_{{$locale}}"
                                                name="text_{{$locale}}"
                                                label="Text {{strtoupper($locale)}}"
                            />
                        @endforeach

                        <x-forms.select-group wire:model="day" name="day" :label="__('Day')">
                            @for($day = 1; $day <= $tour->duration; $day++)
                                <option value="{{$day}}">{{$day}}-й день</option>
                            @endfor
                        </x-forms.select-group>

                        <x-forms.select-group wire:model="time_id" name="time_id" :label="__('Time')"
                                              :options="$foodTimes">
                            <option value="0">Не вибрано</option>
                        </x-forms.select-group>

                        <x-forms.select-group wire:model="region_id" name="region_id" :label="__('Region')"
                                              :options="$regions">
                            <option value="0">Не вибрано</option>
                        </x-forms.select-group>

                        <x-forms.select-group wire:model="food_id" name="food_id" :label="__('Food')"
                                              :select2="true"
                                              :options="$this->foods">
                            <option value="0">Не вибрано</option>
                        </x-forms.select-group>


                        <button type="submit" class="btn btn-primary me-3"
                                wire:loading.class="disabled">@lang('Save')</button>
                        <button type="button" wire:click.prevent="cancelEdit()"
                                class="btn btn-outline-secondary">@lang('Cancel')</button>
                    </form>
                </div>
            </x-slot>
        </x-bootstrap.card>
    @endif


</div>
