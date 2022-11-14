// Usage: https://flatpickr.js.org/
import flatpickr from 'flatpickr'
import rangePlugin from 'flatpickr/dist/plugins/rangePlugin'
import { Ukrainian } from 'flatpickr/dist/l10n/uk'

window.flatpickr = flatpickr

const DatePickerComponent = function () {
    this.init = function () {
        const pickerElements = document.querySelectorAll('.date-picker-group')
        pickerElements.forEach(element => {
            const dateFormat = element.dataset.dateFormat || 'd.m.Y'
            const input = element.querySelector('.flatpicker')
            flatpickr(input, {
                wrap: true,
                locale: Ukrainian,
                dateFormat: dateFormat,
                allowInput: true,
                onChange: function (selectedDates, dateStr, instance) {
                    instance.close()
                    instance._input.blur()
                },
            })
        })
    }
}

const RangePickerComponent = function () {
    this.init = function () {
        const pickerElements = document.querySelectorAll('.range-picker-group')

        pickerElements.forEach(element => {
            const startInput = element.querySelector('.flatpicker-start')
            const endInput = element.querySelector('.flatpicker-end')
            const dateFormat = startInput.dataset.dateFormat || 'Y-m-d'

            const picker = flatpickr(startInput, {
                minDate: Date.now(),
                locale: Ukrainian,
                dateFormat: dateFormat,
                plugins: [new rangePlugin({ input: endInput })],
                onChange: function (selectedDates, dateStr, instance) {
                    console.log(startInput)
                },
            })
        })
    }
}

window.DatePickerComponent = DatePickerComponent

document.addEventListener('DOMContentLoaded', () => {
    new DatePickerComponent().init()
    new RangePickerComponent().init()
})
