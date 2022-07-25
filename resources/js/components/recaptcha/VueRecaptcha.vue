<template>
    <vue-recaptcha-component :size="size"
                   :tabindex="tabindex"
                   @widgetId="setWidgetId"
                   @verify="callbackVerify($event)"
    />
</template>

<script>
import { useRecaptcha, VueRecaptcha as VueRecaptchaComponent } from 'vue3-recaptcha-v2'
import { onMounted, onUnmounted, ref } from 'vue'

export default {
    name: 'VueRecaptcha',
    components: { VueRecaptchaComponent },
    props: {
        size: {
            type: String,
            default: () => 'invisible',
        },
        tabindex: {
            type: Number,
            default: () => 0,
        },
        verify: {
            type: Function,
            default: () => null
        }
    },
    setup(props) {

        const { resetRecaptcha } = useRecaptcha();
        const recaptchaWidget = ref(null);
        const recaptchaInput = ref(null);
        const recaptchaForm = ref(null);

        const callbackVerify = async (response) => {

            $(recaptchaForm.value).off('submit')
            if(typeof props.callback === 'function') {
                await props.callback(response)
            } else {
                $(recaptchaForm.value).submit()
            }
            resetRecaptcha(recaptchaWidget.value)
        };

        const setWidgetId = (event) => {
            recaptchaWidget.value = event

            let id = 'g-recaptcha-response'
            if(recaptchaWidget.value) {
                id += '-' + id
            }
            recaptchaInput.value = document.getElementById(id)
            recaptchaForm.value = recaptchaInput.value.form

            console.log(recaptchaWidget.value)
            console.log(recaptchaInput.value)
            console.log(recaptchaForm.value)

            $(recaptchaForm.value).on('submit', function (e) {
                e.preventDefault()

                grecaptcha.execute()
            })
        }

        return {
            recaptchaWidget,
            setWidgetId,
            callbackVerify,
        }
    }
}
</script>
