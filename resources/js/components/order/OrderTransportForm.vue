<template>
    <div>
        <h2 class="h1">Замовити оренду транспорту</h2>
        <div class="spacer-xs"></div>
        <form action="/" class="row">
            <div class="col-md-6 col-12">
                <label data-tooltip="Поле обов’язкове до заповнення">
                    <i>Прізвище*</i>
                    <input type="text" name="surname" required>
                </label>
            </div>

            <div class="col-md-6 col-12">
                <label data-tooltip="Поле обов’язкове до заповнення">
                    <i>Ім’я*</i>
                    <input type="text" name="name" required>
                </label>
            </div>

            <div class="col-md-6 col-12">
                <label>
                    <i>Email</i>
                    <input type="text" name="email">
                </label>
            </div>

            <div class="col-md-6 col-12">
                <label data-tooltip="Поле обов’язкове до заповнення">
                    <i>Телефон*</i>
                    <input type="tel" name="tel" required>
                </label>
            </div>

            <div class="col-md-6 col-12">
                <div class="single-datepicker">
                    <div class="datepicker-input">
                        <span class="datepicker-placeholder">Дата виїзду*</span>
                        <div class="datepicker-toggle">
                            <div data-range="true" data-multiple-dates-separator=" - "
                                 class="datepicker-here" data-language="uk"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <select>
                    <option value="0" selected disabled>Тривалість*</option>
                    <option value="1">Тривалість 1</option>
                    <option value="2">Тривалість 2</option>
                    <option value="3">Тривалість 3</option>
                </select>
            </div>

            <div class="col-md-6 col-12">
                <label data-tooltip="Поле обов’язкове до заповнення">
                    <i>Маршрут*</i>
                    <input type="text" name="way" required>
                </label>
            </div>

            <div class="col-md-6 col-12">
                <label data-tooltip="Поле обов’язкове до заповнення">
                    <i>Кількість пасажирів*</i>
                    <input type="text" name="passenger" required>
                </label>
            </div>

            <div class="col-md-6 col-12">
                <select>
                    <option value="0" selected disabled>Вікова група пасажирів*</option>
                    <option value="1">Вікова група 1</option>
                    <option value="2">Вікова група 2</option>
                    <option value="3">Вікова група 3</option>
                </select>
            </div>

            <div class="col-md-6 col-12">
                <label>
                    <i>Вайбер</i>
                    <input type="text" name="viber">
                </label>
            </div>

            <div class="col-12">
                <label>
                    <i>Ваш коментар</i>
                    <textarea></textarea>
                </label>
                <div class="text-sm">* обов’язкове для заповнення поле</div>
                <div class="spacer-xs"></div>
                <span class="btn type-1 open-popup" data-rel="thanks-popup">Написати</span>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "OrderTransportForm"
}
</script>

<style scoped>

</style>
