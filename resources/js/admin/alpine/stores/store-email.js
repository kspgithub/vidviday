import tinymce from 'tinymce'
import axios from 'axios'

export default {
    editor: null,
    email: '',
    subject: '',
    message: '',
    show(email) {
        this.email = email
        if (!this.editor) {
            this.editor = tinymce.init({
                selector: '#crm-email-message',
                language: 'uk',

                toolbar:
                    'undo redo | bold italic | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent ' +
                    'emoticons ',
                menubar: '',
                setup: editor => {
                    editor.on('Input', evt => {
                        this.message = editor.getContent()
                    })
                    editor.on('Change', evt => {
                        this.message = editor.getContent()
                    })
                },
                //content_css: 'css/content.css'
            })
        }
    },
    send() {
        axios
            .post('/admin/crm/notify/email', {
                email: this.email,
                subject: this.subject,
                message: this.message,
            })
            .then(({ data }) => {
                if (data.result === 'success') {
                    toast.success(data.message)
                }
            })
            .catch(error => {
                toast.error(error.message)
            })
    },
    cancel() {
        this.email = ''
        this.subject = ''
        this.message = ''
    },
}
