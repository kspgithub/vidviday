<div>
    @if(!$edit)
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Finance')</h2>
                <table class="table table-sm mb-3">
                    <thead>
                    <tr>
                        <th>@lang('Type')</th>
                        <th>@lang('Text') {{strtoupper(app()->getLocale())}}</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->type_id === 1 ? 'У вартість входить' : 'У вартість НЕ входить'}}</td>
                            <td>
                                @if($item->finance)
                                    {!! $item->finance->text !!}
                                @else
                                    {!! $item->text !!}
                                @endif
                            </td>
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

                <a href="#" wire:click.prevent="addItem()" class="btn btn-primary me-2">
                    @lang('Create Record')
                </a>
            </x-slot>
        </x-bootstrap.card>
    @else

        <x-bootstrap.card>
            <x-slot name="body">
                <h4>
                    @if($selectedId > 0)
                        @lang('Editing Record')
                    @else
                        @lang('Creating Record')
                    @endif
                </h4>
                <x-forms.select-group wire:model="type_id"
                                      name="type_id"
                                      :label="__('Type')"
                                      :options="$types">
                    <option value="0">Не вибано</option>
                </x-forms.select-group>

                <x-forms.select-group wire:model="finance_id"
                                      name="finance_id"
                                      :label="__('Template')"
                                      :options="$this->financeOptions">
                    <option value="0">Не вибано</option>
                </x-forms.select-group>

                @foreach($locales as  $locale)
                    <div class="{{(int)$finance_id > 0 ? 'd-none' : ''}}">
                        <x-forms.editor-group wire:model.defer="text_{{$locale}}"
                                              required
                                              name="text_{{$locale}}"
                                              label="{{__('Text')}} {{strtoupper($locale)}}"

                        ></x-forms.editor-group>
                    </div>
                @endforeach



                @if((int)$finance_id > 0)
                    <div class="row mb-3">
                        <div class="col-md-2">@lang('Text')</div>
                        <div class="col-md-10">
                            <div>{!! $this->finance->text !!}</div>
                        </div>
                    </div>
                @endif

                <a href="#" wire:click.prevent="saveItem()" class="btn btn-primary me-2">
                    @lang('Save')
                </a>
                <a href="#" wire:click.prevent="cancelEdit()" class="btn btn-secondary">
                    @lang('Cancel')
                </a>
            </x-slot>
        </x-bootstrap.card>

    @endif

    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>

