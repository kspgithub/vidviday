<template>
    <form @submit="onSubmit" :action="action" method="POST" class="sign-up-form">
        <slot/>
        <div class="tabs vue-tabs">
            <ul class="tab-toggle">
                <li class="tab-caption" :class="{active: role === 'tourist'}" @click.stop="role = 'tourist'">
                    Я турист
                </li>
                <li class="tab-caption" :class="{active: role === 'tour-agent'}" @click.stop="role = 'tour-agent'">
                    Я турагент
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
            <span class="text-sm">* обов’язкове для заповнення поле</span>
            <div class="spacer-xs"></div>
            <div class="text-center">
                <button type="submit" class="btn type-1">Зареєструватись</button>
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
import {scrollToEl} from "../../utils/functions";

export default {
    name: "SignUpForm",
    components: {SingUpSocial, SignUpTourAgent, SignUpTourist},
    props: {
        action: String,
    },
    setup(props) {
        const role = ref('tourist');

        const validationSchema = computed(() => {
            const schema = {
                first_name: 'required',
                last_name: 'required',
                middle_name: 'required',
                email: 'required|email',
                mobile_phone: 'required|tel',
                password: 'required',
                password_confirmation: () => {
                    return values.password === values.password_confirmation ? true : 'Пароль и его подтверждение не совпадают'
                }
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