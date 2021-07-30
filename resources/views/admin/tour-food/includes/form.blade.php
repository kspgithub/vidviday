<x-forms.select-group name="day" :label="__('Day')" :value="old('day', $food->day)" >
    @for($day = 1; $day <= $tour->duration; $day++)
        <option value="{{$day}}" {{$day === $food->$day ? 'selected' : ''}}>{{$day}}-й день</option>
    @endfor
</x-forms.select-group>

<x-forms.select-group name="time_id" :label="__('Time')" :value="old('time_id', $food->time_id)" :options="$foodTimes" />

<x-forms.textarea-group name="text" :label="__('Text')" :value="old('text', $food->text)" required />

@if($food->id > 0)
    <div class="form-group row mb-3">
        <div  class="col-md-2 col-form-label">@lang('Pictures')</div>
        <div class="col-md-10">
            <x-utils.media-library
                :model="$food"
            ></x-utils.media-library>
        </div>
    </div>
@endif
