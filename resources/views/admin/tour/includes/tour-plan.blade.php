<div>
    @if(!$edit)
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-2">@lang('Tour plan')</h2>
                <table class="table table-sm mb-3">
                    <thead>
                    <tr>
                        <th class="text-nowrap">@lang('Title') {{strtoupper(app()->getLocale())}}</th>
                        <th class="text-nowrap">@lang('Text') {{strtoupper(app()->getLocale())}}</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->title}}</td>
                            <td>{{$item->text}}</td>
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
                <h2 class="mb-2">@lang('Tour Plan')</h2>
                <div style="max-width: 768px">
                    <form method="post" wire:submit.prevent="saveItem()">
                        @foreach($locales as  $locale)

                            <x-forms.text-group wire:model.defer="title_{{$locale}}"
                                                required
                                                name="title_{{$locale}}"
                                                label="Title {{strtoupper($locale)}}"
                            />
                        @endforeach


                        @foreach($locales as  $locale)

                            <x-forms.textarea-group wire:model.defer="text_{{$locale}}"
                                                    required
                                                    rows="5"
                                                    name="text_{{$locale}}"
                                                    label="Text {{strtoupper($locale)}}"
                            />
                        @endforeach


                        <button type="submit" class="btn btn-primary me-3">@lang('Save')</button>
                        <button type="button" wire:click.prevent="cancelEdit()"
                                class="btn btn-outline-secondary">@lang('Cancel')</button>
                    </form>
                </div>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>
