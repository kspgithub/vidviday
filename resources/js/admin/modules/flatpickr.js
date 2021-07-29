// Usage: https://flatpickr.js.org/
import flatpickr from "flatpickr";
import rangePlugin from "flatpickr/dist/plugins/rangePlugin";

window.flatpickr = flatpickr;


const DatePickerComponent = function (){
    this.init = function (){
        const pickerElements = document.querySelectorAll('.date-picker-group');

        pickerElements.forEach((element)=>{
            const input = element.querySelector('.flatpicker');
            flatpickr(input, {
                wrap: true
            });
        });

    }
}

const RangePickerComponent = function (){
    this.init = function (){
        const pickerElements = document.querySelectorAll('.range-picker-group');

        pickerElements.forEach((element)=>{
            const startInput = element.querySelector('.flatpicker-start');
            const endInput = element.querySelector('.flatpicker-end');

            const picker = flatpickr(startInput, {
                minDate: Date.now(),
                plugins: [new rangePlugin({ input: endInput})],
                onChange: function(selectedDates, dateStr, instance) {
                    console.log(startInput)
                },
            });
        });

    }
}

window.DatePickerComponent = DatePickerComponent;

document.addEventListener('DOMContentLoaded',  () =>{
    new DatePickerComponent().init();
    new RangePickerComponent().init();
});

