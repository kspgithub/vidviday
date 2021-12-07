export const toCurrency = function (value, currency = 'UAH', locale = 'uk-UA') {
    value = parseFloat(value);
    return value.toLocaleString(locale, {
        style: 'currency',
        currency: currency,
        maximumFractionDigits: 0
    }).replace('KZT', '₸');
}

export const toAmount = function (value, decimal = 0, locale = 'uk-UA') {
    value = parseFloat(value);
    return value.toLocaleString(locale, {
        style: 'decimal',
        maximumFractionDigits: decimal
    });
}

export const convertCurrency = (value, course) =>{
    return Math.ceil(value * course);
}
