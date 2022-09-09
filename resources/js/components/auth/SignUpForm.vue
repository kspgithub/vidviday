<template>
    <form @submit="onSubmit" :action="action" method="POST" class="sign-up-form">
        <slot/>

        <div class="tabs vue-tabs">
            <ul class="tab-toggle">
                <li class="tab-caption" :class="{active: role === 'tourist'}" @click.stop="role = 'tourist'">
                    {{ __('auth.i-am-tourist') }}
                </li>
                <li class="tab-caption" :class="{active: role === 'tour-agent'}" @click.stop="role = 'tour-agent'">
                    {{ __('auth.i-am-travel-agent') }}
                </li>
            </ul>
            <div class="spacer-xs"></div>
            <transition-group name="fade" tag="div" class="tabs-wrap tabs-fade">
                <!-- TAB #1 -->
                <sign-up-tourist v-if="role === 'tourist'" key="sign-up-tourist"/>
                <!-- TAB #1 END -->

                <!-- TAB #2 -->
                <sign-up-tour-agent v-if="role === 'tour-agent'" key="sign-up-tour-agent "/>
                <!-- TAB #2 END -->
            </transition-group>
        </div>
        <div>
            <span class="text-sm">{{ __('forms.required-fields') }}</span>
            <div class="spacer-xs"></div>
            <div class="text-center">
                <button type="submit" class="btn type-1">{{ __('auth.register') }}</button>
            </div>
        </div>
        <div class="spacer-sm"></div>
        <transition name="fade">
            <sing-up-social v-if="role === 'tourist'"/>
        </transition>
    </form>
</template>

<script>
import SignUpTourist from "./SignUpTourist";
import SignUpTourAgent from "./SignUpTourAgent";
import {computed, ref} from "vue";
import SingUpSocial from "./SingUpSocial";
import {useForm} from "vee-validate";
import { getQueryParam } from '../../utils/url.js'
import { trans } from "../../i18n/lang";

export default {
    name: "SignUpForm",
    components: {SingUpSocial, SignUpTourAgent, SignUpTourist},
    props: {
        action: String,
    },
    setup(props) {
        const isTourAgent = getQueryParam('tour_agent');

        const role = ref(isTourAgent ? 'tour-agent' : 'tourist');

        const validationSchema = computed(() => {
            const schema = {
                first_name: 'required|email|min_count:10',
                last_name: 'required',
                middle_name: 'required',
                email: 'required|email',
                mobile_phone: 'required|tel',
                password: 'required',
                password_confirmation: () => {
                    return values.password === values.password_confirmation ? true : trans('validation.confirmed', {attribute: 'password'})
                },
                birthday: 'required|date:DD.MM.YYYY'
            };

            if (role.value === 'tour-agent') {
                schema.company = 'required';
            }

            return schema;
        })

        const {validate, errors, values} = useForm({
            validationSchema: validationSchema,
        });

        const onSubmit = async (event) => {
            const result = await validate();
            if (!result.valid) {
                event.preventDefault();
            }
        }

        return {
            role,
            onSubmit,
        }
    }
}
</script>

<style scoped>

</style>
