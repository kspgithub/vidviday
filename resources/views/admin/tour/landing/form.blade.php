<x-bootstrap.card>
    <x-slot name="body">
        <h2 class="mb-2">@lang('Tour landings') {{ $model?->id }}</h2>
        <div x-data='translatable({locales: @json($tour->locales), trans_expanded: true})'>
            <form x-ref="form" method="post" wire:submit.prevent="saveItem()">

                @if($errors->any())
                    <ul class="text-danger mb-3">
                        @foreach ($errors->all() as $message)
                            <li>{{$message}}</li>
                        @endforeach
                    </ul>

                @endif
                @if (session()->has('success'))
                    <div class="toast-container">
                        <x-utils.toast type="success">
                            {{ session('success') }}
                        </x-utils.toast>
                    </div>
                @endif

                <x-forms.select-group wire:model="form.type_id" name="type_id" :label="__('Type')"
                                      :options="$types">
                    <option value="0">Не вибрано</option>
                </x-forms.select-group>

                @if($form['type_id'] == App\Models\TourLanding::TYPE_TEMPLATE)
                    @include('admin.tour.landing.template_form')
                @endif

                @if($form['type_id'] == App\Models\TourLanding::TYPE_CUSTOM)
                    @include('admin.tour.landing.custom_form')
                @endif

                <button type="submit" class="btn btn-primary me-3"
                        x-on:click.prevent="submit($event, false)"
                        wire:loading.class="disabled">@lang('Save')</button>

                <button type="button" wire:click.prevent="cancelEdit()"
                        class="btn btn-outline-secondary">@lang('Cancel')</button>
            </form>
        </div>
    </x-slot>
</x-bootstrap.card>
