<!-- ONE CLICK POPPUP -->
<div class="popup-content" data-rel="one-click-popup">
    <div class="layer-close"></div>
    <div class="popup-container size-1">
        <div class="popup-align">
            <div class="text-center">
                <span class="h2 title text-medium">Замовити в 1 клік</span>
            </div>
            <div class="spacer-xs"></div>
            <form action="/" class="row">
                <div class="col-md-6 col-12">
                    <label>
                        <i>Прізвище*</i>
                        <input type="text" name="surname" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>Ім’я*</i>
                        <input type="text" name="name" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>Телефон*</i>
                        <input type="tel" name="tel" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>Email*</i>
                        <input type="text" name="email" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <div class="datepicker-input">
                            <span class="datepicker-placeholder">Оберіть дату</span>
                            <div class="datepicker-toggle">
                                <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="number-input">
                        <span class="text-sm text-medium">Кількість осіб*</span>
                        <div class="number-input-btns">
                            <button type="button" class="decrement"></button>
                            <input type="number" step="1" value="1" min="1" max="999" readonly required>
                            <button type="button" class="increment"></button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label>
                        <i>Коментар до замовлення</i>
                        <textarea></textarea>
                    </label>
                    <div class="text-center">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Замовити</span>
                    </div>
                </div>
            </form>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
    </div>
</div>
<!-- ONE CLICK POPPUP END -->

