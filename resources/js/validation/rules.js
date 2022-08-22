import {defineRule, configure} from 'vee-validate';
import {localize, setLocale} from '@vee-validate/i18n';
import ru from '@vee-validate/i18n/dist/locale/ru.json';
import uk from '@vee-validate/i18n/dist/locale/uk.json';

import AllRules from '@vee-validate/rules';

console.log(AllRules)
const veeMessages = {
    ru: {
        messages: {
            "alpha": "Поле может содержать только буквы",
            "alpha_dash": "Поле может содержать только буквы, цифры и дефис",
            "alpha_num": "Поле может содержать только буквы и цифры",
            "alpha_spaces": "Поле может содержать только буквы и пробелы",
            "between": "Поле должно быть между 0:{min} и 1:{max}",
            "confirmed": "Пароль не совпадает подтверждением",
            "digits": "Поле должно быть числовым и точно содержать 0:{length} цифры",
            "dimensions": "Поле должно быть 0:{width} пикселей на 1:{height} пикселей",
            "email": "Не допустимый Email",
            "excluded": "Поле должно быть допустимым значением",
            "ext": "Поле должно быть действительным файлом. ({args})",
            "image": "Поле должно быть изображением",
            "one_of": "Поле должно быть допустимым значением",
            "integer": "Поле должно быть целым числом",
            "length": "Длина поля должна быть 0:{length}",
            "max": "Поле не может быть более 0:{length} символов",
            "max_value": "Поле должно быть 0:{max} или менее",
            "max_count": "Не более 0:{count}",
            "min_count": "Не менее 0:{count}",
            "mimes": "Поле должно иметь допустимый тип файла. ({args})",
            "min": "Поле должно быть не менее 0:{length} символов",
            "min_value": "Поле должно быть 0:{min} или больше",
            "numeric": "Поле должно быть числом",
            "regex": "Поле имеет ошибочный формат",
            "required": "Поле обязательно для заполнения",
            "required_if": "Поле обязательно для заполнения",
            "size": "Поле должно быть меньше, чем 0:{size}KB",
            "url": "Не корректная гиперссылка",
            "linkedin": "Не корректная ссылка linkedin",
            "tel": "Не корректный номер телефона",
        }
    },
    uk: {
        messages: {
            "alpha": "Поле может содержать только буквы",
            "alpha_dash": "Поле может содержать только буквы, цифры и дефис",
            "alpha_num": "Поле может содержать только буквы и цифры",
            "alpha_spaces": "Поле может содержать только буквы и пробелы",
            "between": "Поле должно быть между 0:{min} и 1:{max}",
            "confirmed": "Пароль не совпадает подтверждением",
            "digits": "Поле должно быть числовым и точно содержать 0:{length} цифры",
            "dimensions": "Поле должно быть 0:{width} пикселей на 1:{height} пикселей",
            "email": "Неприйнятний Email",
            "excluded": "Поле должно быть допустимым значением",
            "ext": "Поле должно быть действительным файлом. ({args})",
            "image": "Поле має бути зображенням",
            "one_of": "Поле должно быть допустимым значением",
            "integer": "Поле должно быть целым числом",
            "length": "Длина поля должна быть 0:{length}",
            "max": "Поле не может быть более 0:{length} символов",
            "max_value": "Поле должно быть 0:{max} или менее",
            "max_count": "Не более 0:{count}",
            "min_count": "Не менее 0:{count}",
            "mimes": "Поле повинно мати допустимий тип файлу. ({args})",
            "min": "Поле должно быть не менее 0:{length} символов",
            "min_value": "Поле должно быть 0:{min} или больше",
            "numeric": "Поле должно быть числом",
            "regex": "Поле имеет ошибочный формат",
            "required": "Це поле обов'язкове для заповнення",
            "required_if": "Це поле обов'язкове для заповнення",
            "size": "Поле должно быть меньше, чем 0:{size}KB",
            "url": "Не корректная гиперссылка",
            "linkedin": "Не корректная ссылка linkedin",
            "tel": "Не коректний номер телефону",
        }
    }
}

// Merge validation messages with local translations
const validationMessages = {}

for(let locale in veeMessages) {
    validationMessages[locale] = {messages: {}}

    for(let key in veeMessages[locale].messages) {
        validationMessages[locale][key] = i18n.has('validation.' + key, locale) ? i18n.get('validation.' + key, {attribute: key}, locale) : veeMessages[locale][key]
    }
}

configure({
    generateMessage: localize(validationMessages)
});

setLocale(document.documentElement.lang || 'uk');

Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});

defineRule('url', (value) => {
    if (value) {
        return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)+[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
    }
    return true;
})


const LINKEDIN_RULE = /^(http(s)?:\/\/)?([\w]+\.)?linkedin\.com\/(pub|in|profile)/;
defineRule('linkedin', (value) => {
    return value ? LINKEDIN_RULE.test(value) : true;
})


import PhoneNumber from 'awesome-phonenumber';

defineRule('tel', (value) => {
    if (value) {
        let phone = new PhoneNumber(value);
        return phone.isValid();
    }
    return true;
})

import moment from 'moment';
import { i18n } from '../i18n/lang.js'

defineRule('date', (value, format) => {
    if (value) {
        if (format.length) {
            return moment(value, format[0], true).isValid();
        }
        return moment(value, moment.ISO_8601, true).isValid();
    }
    return true;
})


defineRule('max_count', (value, args) => {

    return value ? Object.keys(value).length <= parseInt(args[0]) : true;
})

defineRule('min_count', (value, args) => {

    return value ? Object.keys(value).length >= parseInt(args[0]) : true;
})
