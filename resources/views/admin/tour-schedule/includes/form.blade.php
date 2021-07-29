<div class="mt-6">
    <h3>@lang('Create Schedule')</h3>
    <div class="row gx-2">
        <div class="col-12 col-xl-5 mb-2 ">
            <div class="d-flex">
                <x-forms.datepicker  wire:model.defer="schedule.start_date"
                                     id="start_date"
                                     name="start_date"
                                     placeholder="{{ __('Start Date')}}"
                                     value="{{$schedule->start_date}}"
                                     required
                                     class="me-2"
                />
                <x-forms.datepicker  wire:model.defer="schedule.end_date"
                                     id="end_date"
                                     name="end_date"
                                     placeholder="{{ __('End Date')}}"
                                     value="{{$schedule->end_date}}"
                                     required
                />
            </div>

        </div>

        <div class="col-12 col-xl-1 mb-2">
            <input  name="places"
                    type="text"
                    id="places"
                    placeholder="{{ __('Places')  }}"
                    value="{{ $schedule->places}}"
                    wire:model.defer="schedule.places"
                    class="form-control"
            />
        </div>
        <div class="col-12 col-xl-2 mb-2">
            <input  name="price"
                    type="text"
                    id="price"
                    placeholder="{{ __('Price')  }}"
                    value="{{ $schedule->price}}"
                    class="form-control"
                    wire:model.defer="schedule.price"
                    required
            />
        </div>
        <div class="col-12 col-xl-2 mb-2">
            <input  name="commission"
                    type="text"
                    id="commission"
                    placeholder="{{ __('Commission')  }}"
                    value="{{ $schedule->commission}}"
                    wire:model.defer="schedule.commission"
                    class="form-control"
            />
        </div>
        <div class="col-12 col-xl-1 mb-2">
            <select name="currency"
                    id="currency"
                    wire:model.defer="schedule.currency"
                    class="form-control"
            >
                @foreach($currencies as $option)
                    <option value="{{ $option['value']}}" {{$option['value'] === $schedule->currency ? 'selected' : ''}}>{{ $option['text']}}</option>
                @endforeach
            </select>

        </div>

        <div class="col-12">
            <button wire:click="save()" class="btn btn-sm btn-primary">@lang('Save')</button>
            @if($schedule->id > 0)
                <button wire:click="cancel()" class="btn btn-sm btn-secondary">@lang('Cancel')</button>
            @endif
        </div>
    </div>
</div>

