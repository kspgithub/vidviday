<div x-init='let editorElement = document.getElementById("template-code");

if(editorElement){
    let editor = ace.edit(document.getElementById("template-code"), {
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
        document.getElementById("template-code-result").value = editor.getValue();
    });
    document.getElementById("template-code-result").value = editor.getValue();
}'>

    <input type="hidden" name="content"  id="template-code-result">
    <x-forms.textarea-group id="template-code" :label="__('Content')" :value="old('text', $viewContent)" />

</div>
