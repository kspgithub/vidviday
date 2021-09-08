<div class="accordion-item">
    <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/calculator.svg')}}"
                   alt="calculator"></span>
        Калькулятор туру <i></i>
    </div>
    <div class="accordion-inner">
        <form action="/" class="calc-form"
              v-is="'tour-calc'"
              :tour='@json($tour->shortInfo())'
              :future-events='@json($future_events)'
              :price-items='@json($price_items)'

        >
            <div class="text-sm">Дата виїзду*</div>
            <div class="single-datepicker">
                <div class="datepicker-input">
                    <span class="datepicker-placeholder">Сб - Нд, 16 - 17.11.2019</span>
                    <!-- <div class="datepicker-toggle">
                        <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                    </div> -->
                </div>
            </div>
            <div class="text">
                <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб
                    з інвалідністю та інших пільгових категорій.</p>
            </div>
            <div class="calc">
                <div class="calc-header">
                    <label class="checkbox">
                        <input type="checkbox" name="all-inclusive">
                        <span>Все включено</span>
                    </label>
                </div>

                <div class="calc-rows-wrap">
                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="tour">
                            <span>Тур</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="895">895</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="tickets-shenborn">
                            <span>Вхідні квитки в палац Шенборна</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="20">20</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="tickets-mukatchevo">
                            <span>Вхідні квитки в Мукачівський замок</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="50">50</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="tickets-pool">
                            <span>Вхідні квитки в басейн «Жайворонок»</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="200">200</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="safe">
                            <span>Оренда шафки</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="20">20</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="vine">
                            <span>Дегустація вин</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="60">60</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="cheese-vine">
                            <span>Дегустація трьох сортів сиру з вином</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="50">50</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="waterfall">
                            <span>Водоспад Шипіт</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="10">10</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="synevyr">
                            <span>Озеро Синевир</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="25">25</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="lunch">
                            <span>Обід у 1-й день</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="90">90</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="dinner">
                            <span>Вечеря у 1-й день</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="80">80</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="breakfast">
                            <span>Сніданок у 2-й день</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="55">55</span> грн</span>
                    </div>

                    <div class="calc-row">
                        <label class="checkbox">
                            <input type="checkbox" name="second-lunch">
                            <span>Обід у 2-й день</span>
                        </label>
                        <div class="number-input">
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1"
                                       max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                        <span class="text-md"><span class="calc-item-price"
                                                    data-price="110">110</span> грн</span>
                    </div>
                </div>
                <div class="calc-footer">
                    <span class="text-sm">Загальна сума: <span class="calc-total-price">0</span> <sup>грн</sup></span>
                </div>
            </div>
        </form>
    </div>
</div>
