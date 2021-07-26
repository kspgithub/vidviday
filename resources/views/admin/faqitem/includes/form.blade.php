<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Faq')</h3>
    </x-slot>

    <x-slot name="body">
        <div class="row">
            <label class="form-label col-md-2" for="Section">Section <span style="color: red">*</span></label>
            <div class="col-md-10">
            <select class="form-select" maxlength="100" class="form-control" name="section" value="old('section', $faqitem->section)">
                <option>common (Загальні запитання)</option>
                <option>corporate (Корпоративні запитання)</option>
                <option>tourist (Туристичні запитання)</option>
                <option>tour-agen (Запитання тур-аґенту)</option>
                <option>certificate (Запит, щодо сертифікатів)</option>
            </select>
            </div>
            </div>
            <br>
        <x-forms.text-group name="question" :label="__('question')" :value="old('question', $faqitem->question)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="answer" :label="__('answer')" :value="old('answer', $faqitem->answer)" maxlength="100" ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

