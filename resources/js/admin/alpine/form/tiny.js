import tinymce from 'tinymce'

const uploadHandler = async (uploadUrl, blobInfo, success, failure) => {
    var xhr, formData
    xhr = new XMLHttpRequest()
    xhr.withCredentials = false

    xhr.open('POST', uploadUrl)
    xhr.setRequestHeader('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]').content)

    xhr.onload = function () {
        var json

        if (xhr.status !== 200) {
            failure('HTTP Error: ' + xhr.status)
            return
        }
        json = JSON.parse(xhr.responseText)

        if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText)
            return
        }
        success(json.location)
    }
    formData = new FormData()
    formData.append('file', blobInfo.blob(), blobInfo.filename())
    xhr.send(formData)
}

export default options => ({
    editor: null,
    value: '',
    init() {
        this.value = this.$refs.valueRef.value
        const selector = '#' + this.$refs.valueRef.getAttribute('id')
        const locale = document.documentElement.lang || 'uk'

        this.editor = tinymce.init({
            content_css: '/css/editor.css',
            selector: selector,
            language: locale,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help',
            ],
            toolbar:
                'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | preview media fullpage | ' +
                'forecolor backcolor emoticons | help | customInsertButton customDateButton',
            menubar: 'favs file edit view insert format tools table help',
            images_upload_handler: async (blobInfo, success, failure) => {
                await uploadHandler(options.uploadUrl, blobInfo, success, failure)
            },
            setup: editor => {
                editor.on('Input', evt => {
                    this.value = editor.getContent()
                })
                editor.on('Change', evt => {
                    this.value = editor.getContent()
                })
                editor.ui.registry.addButton('customInsertButton', {
                    text: 'Html Block',
                    onAction: function (_) {
                        let select = $('<select id="s2" class="form-control"></select>')
                        $('.tox-menubar').append(select)
                        $('#s2').select2({
                            theme: 'bootstrap-5',
                            ajax: {
                                url: '/api/html-blocks',
                                dataType: 'json',
                                quietMillis: 500,
                                data: function (params) {
                                    self.prevQuery = params
                                    return {
                                        q: params.term,
                                        page: params.page || 1,
                                        limit: 20,
                                    }
                                },
                            },
                        })
                        $('#s2').on('select2:select', e => {
                            editor.insertContent('{{' + e.params.data.id + '}}')
                        })
                        $('#s2').select2('open')
                    },
                })
            },
            //content_css: 'css/content.css'
        })
    },
})
