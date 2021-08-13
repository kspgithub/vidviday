export const toCurrency = function (value, currency){
    value = parseFloat(value);
    return value.toLocaleString('ru-RU', {
        style: 'currency',
        currency: currency,
        maximumFractionDigits: 0
    }).replace('KZT', '₸');
}

export const toAmount = function (value, decimal = 0){
    value = parseFloat(value);
    return value.toLocaleString('ru-RU', {
        style: 'decimal',
        maximumFractionDigits: decimal
    });
}

export const convertCurrency = (value, course) =>{
    return Math.ceil(value * course);
}
