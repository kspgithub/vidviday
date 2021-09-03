<div>
    @if(!$edit)
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Tour Food')</h2>
                <table class="table table-sm mb-3">
                    <thead>
                    <tr>
                        <th class="text-nowrap">@lang('Day')</th>
                        <th class="text-nowrap">@lang('Time')</th>
                        <th class="text-nowrap">@lang('Text')</th>
                        <th class="text-nowrap">@lang('Pictures Count')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->day}}-й день</td>
                            <td class="text-nowrap">{{$item->time->title}}</td>
                            <td>{{$item->text}}</td>
                            <td>{{$item->media_count}}</td>

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
                <h2 class="mb-2">@lang('Tour Food')</h2>
                <div>
                    <form method="post" wire:submit.prevent="saveItem()">

                        <x-forms.select-group wire:model="day" name="day" :label="__('Day')">
                            @for($day = 1; $day <= $tour->duration; $day++)
                                <option value="{{$day}}">{{$day}}-й день</option>
                            @endfor
                        </x-forms.select-group>

                        <x-forms.select-group wire:model="time_id" name="time_id" :label="__('Time')"
                                              :options="$foodTimes"/>


                        @foreach($locales as  $locale)

                            <x-forms.textarea-group wire:model.defer="text_{{$locale}}"
                                                    required
                                                    rows="5"
                                                    name="text_{{$locale}}"
                                                    label="{{__('Text')}} {{strtoupper($locale)}}"
                            />
                        @endforeach

                        @if($selectedId > 0)
                            <div class="form-group row mb-3">
                                <div class="col-md-2 col-form-label">@lang('Pictures')</div>
                                <div class="col-md-10">
                                    <x-utils.media-library
                                        :model="$model"
                                    ></x-utils.media-library>
                                </div>
                            </div>

                            <script>
                                const library = document.querySelector('[data-media-upload]');
                                if (library) {
                                    const lib = new MediaLibrary(library);
                                }

                            </script>
                        @else
                            <div class="form-group row mb-3">
                                <div class="col-md-2 col-form-label">@lang('Pictures')</div>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" accept=".jpg,.jpeg,.png"
                                           wire:model.defer="pictures" multiple>
                                    @error('pictures.*') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
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
