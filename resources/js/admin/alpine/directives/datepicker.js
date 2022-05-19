import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";

export default (el) => {
    flatpickr(el, {
        locale: Ukrainian,
        allowInput: true,
        dateFormat: 'd.m.Y',
        defaultDate: el.value,
    });
}
