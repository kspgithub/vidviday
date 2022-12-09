import {defineRule, configure} from 'vee-validate';
import {localize, setLocale} from '@vee-validate/i18n';

import ru from '@vee-validate/i18n/dist/locale/ru.json';
import uk from '@vee-validate/i18n/dist/locale/uk.json';

import AllRules from '@vee-validate/rules';

const countries = useCountries()

const veeMessages = {
    ru: {
        messages: {
            ...ru,
            "alpha": "Поле {field} может содержать только буквы",
            "alpha_dash": "Поле {field} может содержать только буквы, цифры и дефис",
            "alpha_num": "Поле {field} может содержать только буквы и цифры",
            "alpha_spaces": "Поле {field} может содержать только буквы и пробелы",
            "between": "Поле {field} должно быть между 0:{min} и 1:{max}",
            "confirmed": "Поле {field} не совпадает Подтверждение",
            "digits": "Поле {field} должно быть числовым и точно содержать 0:{length} цифры",
            "dimensions": "Поле {field} должно быть 0:{width} пикселей на 1:{height} пикселей",
            "email": "Поле {field} должно быть действительным электронным адресом",
            "excluded": "Поле {field} должно быть допустимым значением",
            "ext": "Поле {field} должно быть действительным файлом. ({args})",
            "image": "Поле {field} должно быть изображением",
            "one_of": "Поле {field} должно быть допустимым значением",
            "integer": "Поле {field} должно быть целым числом",
            "length": "Длина поля {field} должна быть 0:{length}",
            "max": "Поле {field} не может быть более 0:{length} символов",
            "max_value": "Поле {field} должно быть 0:{max} или менее",
            "mimes": "Поле {field} должно иметь допустимый тип файла. ({args})",
            "min": "Поле {field} должно быть не менее 0:{length} символов",
            "min_value": "Поле {field} должно быть 0:{min} или больше",
            "numeric": "Поле {field} должно быть числом",
            "regex": "Поле {field} имеет ошибочный формат",
            "required": "Поле {field} обязательно для заполнения",
            "required_if": "Поле {field} обязательно для заполнения",
            "size": "Поле {field} должно быть меньше, чем 0:{size}KB",
        },
    },
    uk: {
        ...uk,
        messages: {
            "alpha": "Поле {field} може містити тільки літери",
            "alpha_dash": "Поле {field} може містити буквено-цифрові символи, а також тире та підкреслення",
            "alpha_num": "Поле {field} може містити тільки літери та цифри",
            "alpha_spaces": "Поле {field} може містити тільки літери та пробіли",
            "between": "Поле {field} повинно бути між 0:{min} та 1:{max}",
            "confirmed": "Поле {field} не співпадає з підтвердженням",
            "digits": "Поле {field} повинно бути числовим та точно містити 0:{length} цифри",
            "dimensions": "Поле {field} повинно бути 0:{width} пікселів на 1:{height} пікселів",
            "email": "В полі {field} повинна бути адреса електронної пошти",
            "excluded": "Поле {field} повинно мати допустиме значення",
            "ext": "Поле {field} повинно бути дійсним файлом",
            "image": "В полі {field} має бути зображення",
            "one_of": "Поле {field} повинно бути допустимим значенням",
            "integer": "Поле {field} должно быть целым числом",
            "length": "Длина поля {field} должна быть 0:{length}",
            "max": "Поле {field} не може бути більше, ніж 0:{length} символів",
            "max_value": "Поле {field} повинно бути 0:{max} або менше",
            "mimes": "Поле {field} повиннно мати дійсний тип файлу",
            "min": "Поле {field} має бути принаймні 0:{length} символів",
            "min_value": "Поле {field} повинно бути 0:{min} або більше",
            "numeric": "Поле {field} може містить лише цифри",
            "regex": "Поле {field} має невірний формат",
            "required": "Поле {field} повинно мати значення",
            "required_if": "Поле {field} повинно мати значення",
            "size": "Поле {field} повинно бути менше 0:{size}KB",
        }
    }
}

const LINKEDIN_RULE = /^(http(s)?:\/\/)?([\w]+\.)?linkedin\.com\/(pub|in|profile)/;
import PhoneNumber from 'awesome-phonenumber';

const customRules = {
    'url': (value) => {
        if (value) {
            return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)+[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
        }
        return true;
    },
    'linkedin': (value) => {
        return value ? LINKEDIN_RULE.test(value) : true;
    },
    'tel': (value) => {
        if (value) {
            // let phone = new PhoneNumber(value);
            // return phone.isValid();
            const country = countries.find(c => value.startsWith(c.phone_code))
            if(country?.phone_rule) {
                const regex = new RegExp(country.phone_rule.replaceAll('\/', ''))
                console.log(regex)
                return regex.test(value)
            } else {
                return /^\+38 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$/.test(value)
            }
        }
        return true;
    },
    'date': (value, args) => {
        if (value) {
            if (args.length) {
                return moment(value, args[0], true).isValid();
            }
            return moment(value, moment.ISO_8601, true).isValid();
        }
        return true;
    },
    'max_count': (value, args) => {
        return value ? Object.keys(value).length <= parseInt(args[0]) : true;
    },
    'min_count': (value, args) => {
        return value ? Object.keys(value).length >= parseInt(args[0]) : true;
    },
}

// Merge validation messages with local translations
const validationMessages = {}

const translateRuleMessage = (form, key, locale) => {

    const attributeTranslation = i18n.has('validation.attributes.' + form.field, locale) ?
        i18n.get('validation.attributes.' + form.field, {}, locale) :
        (
            i18n.has('forms.' + form.field, locale) ?
                i18n.get('forms.' + form.field, {}, locale) :
                form.field
        )

    const params = {};

    for (let i in form.rule.params) {
        params[i] = form.rule.params[i]
    }

    return i18n.has('validation.' + key, locale) ?
        i18n.get('validation.' + key, { attribute: attributeTranslation, ...params }, locale) :
        veeMessages[locale][key] || i18n.get('validation.invalid', { attribute: attributeTranslation, ...params }, locale)
}

for (let locale in veeMessages) {
    validationMessages[locale] = { messages: {} }

    for (let key in veeMessages[locale].messages) {
        validationMessages[locale].messages[key] = form => translateRuleMessage(form, key, locale)
    }

    for (let key in AllRules) {
        validationMessages[locale].messages[key] = form => translateRuleMessage(form, key, locale)

        defineRule(key, AllRules[key]);
    }

    for (let key in customRules) {
        validationMessages[locale].messages[key] = form => translateRuleMessage(form, key, locale)

        defineRule(key, customRules[key])
    }
}

configure({
    generateMessage: localize(validationMessages)
});

setLocale(document.documentElement.lang || 'uk');

import moment from 'moment';
import { i18n } from '../i18n/lang.js'
import { useCountries } from "../useCountries";
