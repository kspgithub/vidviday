<!-- CALL BACK POPPUP -->
<div class="popup-content" data-rel="call-back-popup">
    <div class="layer-close"></div>
    <div class="popup-container size-1">
        <div class="popup-align">
            <div class="text-center">
                <span class="h2 title text-medium">Замовити дзвінок</span>
            </div>
            <div class="spacer-xs"></div>
            <form action="/" class="row">
                <div class="col-md-6 col-12">
                    <label data-tooltip="Поле обов’язкове до заповнення">
                        <i>{{__('forms.your-name')}}*</i>
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
                    <label>
                        <i>{{__('forms.email')}}</i>
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

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <div class="datepicker-input">
                            <span class="datepicker-placeholder">Дата дзвінка</span>
                            <div class="datepicker-toggle">
                                <div class="datepicker-here" data-language="uk"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="timepicker-input">
                        <select>
                            <option value="0" selected disabled>Час дзвінка</option>
                            <option value="1">11:00</option>
                            <option value="2">12:00</option>
                            <option value="3">13:00</option>
                            <option value="4">14:00</option>
                            <option value="5">15:00</option>
                            <option value="6">16:00</option>
                            <option value="7">17:00</option>
                            <option value="8">18:00</option>
                            <option value="9">19:00</option>
                            <option value="10">20:00</option>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <label>
                        <i>Примітки</i>
                        <textarea></textarea>
                    </label>
                    <div class="text text-sm">{{__('forms.required-fields')}}</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Замовити дзвінок</span>
                    </div>
                </div>
            </form>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
    </div>
</div>
<!-- CALL BACK POPPUP END -->
