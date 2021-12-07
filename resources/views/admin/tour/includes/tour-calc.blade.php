<div>
    @if(!$edit)
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>@lang('Title')</th>
                <th>@lang('Limited')</th>
                <th>@lang('Places')</th>
                <th style="text-align: right">@lang('Price')</th>
                <th>@lang('Currency')</th>
                <th>@lang('Published')</th>
                <th>@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>@lang('Tour')</td>
                <td></td>
                <td></td>
                <td style="text-align: right">{{$tour->price}}</td>
                <td>{{$tour->currency}}</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->limited ? __('yes') : __('no')}}</td>
                    <td>{{$item->places}}</td>
                    <td style="text-align: right">{{$item->price}}</td>
                    <td>{{$item->currency}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   {{$item->published ? 'checked' : ''}}
                                   wire:change="togglePublished({{$item->id}})"
                                   type="checkbox" id="published-{{$item->id}}">
                            <label class="form-check-label" for="published-{{$item->id}}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="editItem({{$item->id}})"
                           class="btn btn-sm btn-outline-primary m-1"><i
                                class="fa fa-edit"></i></a>
                        <a href="#deleteModal" wire:click="deleteId({{$item->id}})"
                           data-bs-toggle="modal"
                           class="btn btn-sm btn-outline-danger m-1"

                        ><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="#" class="btn btn-primary" wire:click.prevent="addItem()">@lang('Create Record')</a>
    @endif
    @if($edit)
        <form method="post" wire:submit.prevent="saveItem()">
            @foreach($locales as  $locale)

                <x-forms.text-group wire:model.defer="title_{{$locale}}"
                                    required
                                    name="title_{{$locale}}"
                                    label="Title {{strtoupper($locale)}}"
                />
            @endforeach

            <x-forms.text-group wire:model.defer="price" :label="__('Price')"/>
            <x-forms.select-group wire:model.defer="currency" :label="__('Currency')" :options="$currencies"/>
            <x-forms.switch-group wire:model="limited" :label="__('Limited')"/>
            @if($limited)
                <x-forms.text-group wire:model.defer="places" type="number" :label="__('Places')"/>
            @endif
            <x-forms.switch-group wire:model.defer="published" :label="__('Published')"/>

            <button type="submit" class="btn btn-primary me-3" wire:loading.class="disabled">@lang('Save')</button>
            <button type="button" wire:click.prevent="cancelEdit()"
                    class="btn btn-outline-secondary">@lang('Cancel')</button>
        </form>
    @endif
    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>
