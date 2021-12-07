import {useI18n} from "vue-i18n";
import {computed} from "vue";


export const useLocalizedProperty = (model, property) => {
    const {locale, fallbackLocale} = useI18n({useScope: 'global'});
    return computed({
        get() {
            if (model[property]) {
                return model[property][locale.value] ? model[property][locale.value] : model[property][fallbackLocale.value];
            } else {
                console.log(`Property '${property}' not fount in model: `, model);
                return '';
            }
        },
        set(value) {
            if (model[property]) {
                model[property][locale.value] = value;
            } else {
                console.log(`Property '${property}' not fount in model: `, model);
            }
        }
    });
}


