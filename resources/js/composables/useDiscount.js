export const calcChildDiscount = (price, persons, days = 0, discount = null) => {
    let total = 0;
    if (price && persons && discount) {
        console.log(price, persons, days, discount);
        if (discount.type === 1 || discount.type === 'percent') {
            let totalPrice = persons * price;
            total += (totalPrice / 100) * discount.price;
        } else {
            switch (discount.duration) {
                case 'person':
                    total += discount.price * persons;
                    break;
                case 'person-day':
                    total += discount.price * persons * days;
                    break;
                default:
                    total += discount.price;
                    break;
            }
        }
    }
    return total;
}
