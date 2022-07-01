import Choices from "choices.js";

window.Choices = Choices;


document.addEventListener('DOMContentLoaded', () => {
    const tagSelects = document.querySelectorAll('.select-choices');


    tagSelects.forEach((el) => {
        const plug = new Choices(el, {
            removeItemButton: true
        });
        plug.passedElement.element.addEventListener('change', () => {
            const values = plug.getValue(true);

        });
    });


})
