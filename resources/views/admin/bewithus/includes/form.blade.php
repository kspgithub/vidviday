<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>

        @foreach($bewithus as $item)
            <div class="draggable" data-id="{{$item->id}}">
                <x-forms.text-loc-group name="url[{{$item->id}}]" :label="old('title', $item->getTranslation('title', 'uk'))"
                                        :value="old('url', $item->getTranslations('url'))" maxlength="100"
                                        required></x-forms.text-loc-group> 
            </div>
        @endforeach
    </div>
</div>