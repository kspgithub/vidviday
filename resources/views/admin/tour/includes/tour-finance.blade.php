<div>
    @if(!$edit)
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Finance')</h2>
                <table class="table table-sm mb-3">
                    <thead>
                    <tr>
                        <th>@lang('Type')</th>
                        <th>@lang('Title') {{strtoupper(app()->getLocale())}}</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->type->title}}</td>
                            <td>{{$item->title}}</td>
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
                <x-forms.select-group wire:model.defer="type_id"
                                      name="type_id"
                                      label="Type"
                                      :options="$types"/>
                @foreach($locales as  $locale)

                    <x-forms.text-group wire:model.defer="title_{{$locale}}"
                                        required
                                        name="title_{{$locale}}"
                                        label="Title {{strtoupper($locale)}}"

                    />
                @endforeach


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

