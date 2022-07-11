<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>

        <div class="row">
            <label class="form-label col-md-2" for="section">Розділ <span style="color: red">*</span></label>
            <div class="col-md-10">
                <select class="form-select form-control" maxlength="100" name="section" id="section">
                    @foreach(\App\Models\FaqItem::$sections as $value=>$title)
                        <option
                            value="{{$value}}" {{old('question', $faqitem->section) === $value ? 'selected' : ''}}>{{$title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <x-forms.textarea-loc-group name="question" :label="__('Question')"
                                    :value="old('question', $faqitem->getTranslations('question'))"
                                    required/>

        <x-forms.editor-loc-group name="answer" :label="__('Answer')"
                                  :value="old('answer', $faqitem->getTranslations('answer'))"
                                  required/>

        <x-forms.switch-group name="published" :label="__('Published')"
                              :active="old('published', $faqitem->published)"/>
    </div>


</div>
