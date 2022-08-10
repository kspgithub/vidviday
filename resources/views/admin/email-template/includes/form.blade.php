<div x-data='translatable({share: {locales: @json($locales)}})' x-init='

console.log(trans_locale, locales)

for(let locale of locales) {
    let editorElement = document.getElementById("template-code-" + locale);

    if(editorElement){
        let editor = ace.edit(document.getElementById("template-code-" + locale), {
            mode: "ace/mode/html",
            theme: "ace/theme/dracula",
            maxLines: 50,
            minLines: 10,
            fontSize: 18
        })
        editor.setOptions({
            autoScrollEditorIntoView: true,
            copyWithEmptySelection: true,
        });
        editor.on("change", function(e){
            document.getElementById("template-code-result-" + locale).value = editor.getValue();
        });
        document.getElementById("template-code-result-" + locale).value = editor.getValue();
    }
}'>


    <x-forms.translation-switch/>

    <x-forms.text-loc-group name="subject" :label="__('Subject')" :value="old('subject', $template->getTranslations('subject'))"/>

    @foreach($locales as $locale)
        <input type="hidden" name="html[{{$locale}}]" id="template-code-result-{{$locale}}">


        <div x-show="trans_locale === '{{$locale}}'">
            <x-forms.textarea-group id="template-code-{{$locale}}" :label="__('Content') . '['.$locale.']'" :value="old('html', $template->getTranslation('html', $locale))"/>
        </div>

    @endforeach


</div>
