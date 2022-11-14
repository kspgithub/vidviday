<template>
    <div class="tab active">
        <div class="form row">
            <div class="col-12">
                <span class="h3">{{ __('certificate-section.donor-data') }}</span>
                <div class="spacer-xs"></div>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="last_name" :label="__('forms.your-last-name')" name="last_name" rules="required" />
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="first_name" :label="__('forms.your-name')" name="first_name" rules="required" />
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    id="order-phone"
                    v-model="phone"
                    :label="__('forms.phone-number')"
                    name="phone"
                    mask="+38 (099) 999-99-99"
                    rules="required|tel"
                />
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    id="order-email"
                    v-model="email"
                    :label="__('forms.email')"
                    name="email"
                    rules="required|email"
                />
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <span class="h3">{{ __('certificate-section.recipient-data') }}</span>
                <div class="spacer-xs"></div>
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    v-model="last_name_recipient"
                    :label="__('forms.last-name')"
                    name="last_name_recipient"
                    rules="required"
                />
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    v-model="first_name_recipient"
                    :label="__('forms.name')"
                    name="first_name_recipient"
                    rules="required"
                />
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <span class="h3">{{ __('certificate-section.certificate-details') }}</span>
                <div class="spacer-xs"></div>
                <label class="radio">
                    <input v-model="type" type="radio" value="sum" name="type" />
                    <span>{{ __('certificate-section.type-sum') }}</span>
                </label>
                <label class="radio">
                    <input v-model="type" type="radio" value="tour" name="type" />
                    <span>{{ __('certificate-section.type-tour') }}</span>
                </label>
                <div class="text">
                    <p>{{ __('certificate-section.type-description') }}</p>
                </div>
                <div class="spacer-xs"></div>
            </div>

            <transition name="fade">
                <div v-if="type === 'sum'" key="type-sum" class="col-md-6 col-12">
                    <form-input v-model.number="sum" type="number" label="Сума" name="sum" rules="required" />
                </div>
            </transition>
            <div class="w-100"></div>
            <transition name="fade">
                <div v-if="type === 'tour'" key="type-tour" class="col-md-8 col-12">
                    <form-tour-autocomplete
                        v-model="tour_id"
                        :tour="tour"
                        option-title="price_title"
                        @select="selectTour"
                    />

                    <form-number-input
                        v-model="places"
                        :title="__('certificate-section.number-of-people')"
                        :min="1"
                        :max="999"
                        name="places"
                    />

                    <div class="spacer-xs"></div>
                </div>
            </transition>
            <div v-if="false" class="col-12">
                <span class="text-sm"
                    ><b>{{ __('certificate-section.design-title') }}</b></span
                >
                <br />
                <label class="radio">
                    <input v-model="design" type="radio" value="classic" name="design" />
                    <span>{{ __('certificate-section.design-classic') }}</span>
                </label>
                <label class="radio">
                    <input v-model="design" type="radio" value="heart" name="design" />
                    <span>{{ __('certificate-section.design-heart') }}</span>
                </label>
                <div class="spacer-xs"></div>
            </div>
            <div class="col-12">
                <span class="text-sm"
                    ><b>{{ __('certificate-section.format-title') }}</b></span
                >
                <br />
                <label class="radio">
                    <input v-model="format" type="radio" value="printed" name="format" />
                    <span>{{ __('certificate-section.format-printed') }}</span>
                </label>
                <label class="radio">
                    <input v-model="format" type="radio" value="electronic" name="format" />
                    <span>{{ __('certificate-section.format-electronic') }}</span>
                </label>
                <div class="spacer-xs"></div>
            </div>

            <transition name="fade">
                <div v-if="format === 'printed'" id="block-certificate-format-1" class="col-12 cert-upak">
                    <span class="text-sm"
                        ><b>{{ __('certificate-section.packing-title') }}</b></span
                    >
                    <br />
                    <div class="ans">{{ __('certificate-section.packing-description') }}</div>
                    <label class="radio">
                        <input v-model="packing" type="radio" :value="1" name="packing" />
                        <span>{{ __('certificate-section.yes') }}</span>
                    </label>
                    <label class="radio">
                        <input v-model="packing" type="radio" :value="0" name="packing" />
                        <span>{{ __('certificate-section.no') }}</span>
                    </label>
                    <div class="spacer-xs"></div>
                </div>
            </transition>

            <transition name="fade">
                <div v-if="format === 'printed' && packing === 1" class="col-12 upak-variant">
                    <span class="text-sm"
                        ><b>{{ __('certificate-section.packing-variant') }}</b></span
                    >
                    <br />
                    <label v-for="(packing, i) in packings" :key="i" class="radio">
                        <input v-model="packing_type" type="radio" :value="packing.slug" name="packing_type" />

                        <span>
                            {{ packing.title[locale] || packing.title['uk'] }}
                            <div class="img-ic"><img :src="packing.icon" alt="" /></div>
                            <div class="cina">
                                {{ __('certificate-section.price') }}: {{ packing.price }}
                                {{ __('certificate-section.uah') }}
                            </div>
                        </span>
                    </label>
                    <div class="spacer-xs"></div>
                </div>
            </transition>

            <div class="col-12">
                <certificate-total />
            </div>
        </div>
    </div>
</template>

<script>
import FormInput from '../form/FormInput'
import { useStore } from 'vuex'
import { useFormDataProperty } from '../../store/composables/useFormData'
import { computed } from 'vue'
import FormNumberInput from '../form/FormNumberInput'
import FormTourAutocomplete from '../form/FormTourAutocomplete'
import { locale } from '../../i18n'
import CertificateTotal from './CertificateTotal'

export default {
    name: 'CertificateStepOne',
    components: { CertificateTotal, FormTourAutocomplete, FormNumberInput, FormInput },
    props: {
        errors: {
            type: Object,
            default: () => {},
        },
    },
    setup() {
        const locale = locale
        const store = useStore()
        const tour = computed(() => store.state.orderCertificate.tour)
        const packings = computed(() => store.state.orderCertificate.packings)
        const design = computed(() => store.state.orderCertificate.design)

        const selectTour = tour => {
            store.commit('orderCertificate/SET_TOUR', tour)
        }

        return {
            first_name: useFormDataProperty('orderCertificate', 'first_name'),
            last_name: useFormDataProperty('orderCertificate', 'last_name'),
            email: useFormDataProperty('orderCertificate', 'email'),
            phone: useFormDataProperty('orderCertificate', 'phone'),
            first_name_recipient: useFormDataProperty('orderCertificate', 'first_name_recipient'),
            last_name_recipient: useFormDataProperty('orderCertificate', 'last_name_recipient'),
            type: useFormDataProperty('orderCertificate', 'type'),
            // design: useFormDataProperty('orderCertificate', 'design'),
            format: useFormDataProperty('orderCertificate', 'format'),
            sum: useFormDataProperty('orderCertificate', 'sum'),
            tour_id: useFormDataProperty('orderCertificate', 'tour_id'),
            places: useFormDataProperty('orderCertificate', 'places'),
            packing: useFormDataProperty('orderCertificate', 'packing'),
            packing_type: useFormDataProperty('orderCertificate', 'packing_type'),
            packings,
            design,
            tour,
            selectTour,
            locale,
        }
    },
}
</script>

<style scoped></style>
