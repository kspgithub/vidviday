<div>
    @if(!$edit)
        <div style="position: relative; overflow: auto">
            <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 1000px;">
                @foreach($items as $item)
                    <li class="list-group-item draggable d-flex align-items-center"
                        style="width: 1000px;"
                        wire:sortable.item="{{ $item->id }}"
                        wire:key="place-{{ $item->id }}">
                        <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                        <div class="me-3">
                            <div><b>{{__('Question')}}:</b> {{$item->question}}</div>
                            <div><b>{{__('Answer')}}:</b> {{$item->answer}}</div>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="text-info me-2" wire:click.prevent="editItem({{$item->id}})">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#deleteModal" class="text-danger" wire:click.prevent="deleteId({{$item->id}})"
                               data-bs-toggle="modal">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

        <button type="button" class="btn btn-primary me-2"
                wire:click.prevent="addItem()">@lang('Create Record')</button>
    @endif
    
    @if($edit)
        <div x-data="translatable()">
            <div class="d-flex align-items-center">
                @foreach(siteLocales() as $lang)
                    <a href="#" x-on:click.prevent="trans_locale = '{{ $lang }}'"
                    :class="{['btn-primary']: trans_locale === '{{ $lang }}'}"
                    :disabled="trans_locale === '{{ $lang }}'"
                    class="btn btn-md btn-default">{{strtoupper($lang)}}</a>
                @endforeach
            </div>

            @foreach(siteLocales() as $lang)
                <div data-lang="{{$lang}}" x-show="trans_locale == '{{ $lang }}' || trans_expanded" >
                        <x-forms.textarea-group wire:model="question.{{$lang}}" :label="__('Question')"/>
                        <x-forms.textarea-group wire:model="answer.{{$lang}}" :label="__('Answer')"/>
                </div>
            @endforeach

            <button type="button" class="btn btn-primary me-2"
                            wire:click.prevent="saveItem()">@lang('Save')</button>
            <button type="button" class="btn btn-secondary"
                    wire:click.prevent="cancelEdit()">@lang('Cancel')</button>
        </div>
    @endif
    @include("livewire-tables::bootstrap-5.includes.delete-modal")
</div>


