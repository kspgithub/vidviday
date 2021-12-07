<div>
    <x-bootstrap.card>
        <x-slot name="body">
            <h2 class="mb-2">@lang('Tour Plan')</h2>
            <div style="max-width: 768px">
                <form method="post" wire:submit.prevent="saveItem()">


                    @foreach($locales as  $locale)
                        <x-forms.editor-group wire:model.defer="text_{{$locale}}"
                                              name="model.text_{{ $locale }}"
                                              id="text_{{ $locale }}"
                                              label="Text {{strtoupper($locale)}}"
                                              required
                        >

                        </x-forms.editor-group>

                    @endforeach


                    <button type="submit" class="btn btn-primary me-3">@lang('Save')</button>
                </form>
            </div>
        </x-slot>
    </x-bootstrap.card>
</div>
