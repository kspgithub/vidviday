@php
    $replaces = match($notification->key) {
        'order' => ['order_id'],
        'register-tour-agent' => ['user_id'],
        'order-one-click' => ['order_id'],
        'staff-testimonial' => ['testimonial_id'],
        'corporate' => ['order_id'],
        'certificate' => ['order_id'],
        default => ['order_id'],
    };
@endphp

<div x-data='translatable({share: {locales: @json($locales)}})'>

    <x-forms.translation-switch/>

    <div class="form-group row mb-3">
        <label for="subject" class="col-md-2 col-form-label">
            Доступні змінні
        </label>

        <div class="col-md-10">
            <div class="input-group mb-1">
                @foreach($replaces as $replace)
                    @php
                        $text = '{{'.$replace.'}}'
                    @endphp
                    <div id="replace-{{ $replace }}" class="replace col-12">
                        <span class="me-1">{{$text}}</span>
                        <a class="copy" href="#" data-clip-copy="{{$text}}"><i data-feather="copy"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-forms.text-loc-group name="title" :label="__('Title')"
                            :value="old('title', $notification->getTranslations('title'))"/>

    <x-forms.textarea-loc-group name="text" :label="__('Text')"
                                :value="old('text', $notification->getTranslations('text'))"/>

    <x-forms.switch-group name="phone" label="Телефон" :active="old('phone', $notification->phone)"/>

    <x-forms.switch-group name="viber" label="Viber" :active="old('viber', $notification->viber)"/>

</div>
