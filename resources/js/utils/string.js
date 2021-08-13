import {createElement} from "./dom";

export const stripHtml = function (html) {
    let tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}

/**
 *
 * @param {number} input
 * @param {string} one
 * @param {string} two
 * @param {string} many
 * @returns {string}
 */
export const pluralize = function (input, one, two, many) {
    if (input % 10 === 1 && input % 100 !== 11) {
        return one;
    }
    if (input % 10 >= 2 && input % 10 <= 4 && (input % 100 < 10 || input % 100 >= 20)) {
        return two;
    }
    return many;
}

/**
 *
 * @param {number} input
 * @param {string} one
 * @param {string} two
 * @param {string} many
 * @returns {string}
 */
export const pluralizeValue = function (input, one, two, many) {
    return input + ' ' + pluralize(input, one, two, many);
}


/**
 * @param {string} text
 * @returns {string}
 */
export const nl2br = function (text) {
    const parts = text.split('\n');
    return parts.join('<br />');
}
