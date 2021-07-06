<!-- WRITE MESSAGE POPUP -->
<div class="popup-content" data-rel="write-message-popup">
    <div class="layer-close"></div>
    <div class="popup-container size-1">
        <div class="popup-align">
            <div class="text-center">
                <span class="h2 title text-medium">Написати листа</span>
            </div>
            <div class="spacer-xs"></div>
            <form action="/" class="row">
                <div class="col-md-6 col-12">
                    <label data-tooltip="Поле обов’язкове до заповнення">
                        <i>Ваше Ім’я*</i>
                        <input type="text" name="name" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label data-tooltip="Поле обов’язкове до заповнення">
                        <i>Номер телефону*</i>
                        <input type="tel" name="tel" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label data-tooltip="Поле обов’язкове до заповнення">
                        <i>Email</i>
                        <input type="text" name="email">
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <select>
                        <option value="0" selected disabled>Тип запитання</option>
                        <option value="1">Тип запитання 1</option>
                        <option value="2">Тип запитання 2</option>
                        <option value="3">Тип запитання 3</option>
                    </select>
                </div>

                <div class="col-12">
                    <label>
                        <i>Текст повідомлення</i>
                        <textarea></textarea>
                    </label>
                    <div class="text text-sm">* обов’язкове для заповнення поле</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Надіслати</span>
                    </div>
                </div>
            </form>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
    </div>
</div>
<!-- WRITE MESSAGE POPUP END -->
