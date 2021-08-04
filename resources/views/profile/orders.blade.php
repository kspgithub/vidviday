@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.tourist-tabs')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #2 -->
                    <div class="tab active" id="history">
                        <div class="only-desktop-pad">
                            <h2 class="h2">Історія замовлень</h2>
                            <hr>
                        </div>
                        <div class="accordion type-1">
                            <div class="accordion-item">
                                <div class="accordion-title">
                                    <span class="text">23.12.2019</span>
                                    <span class="h4">Манява — Драгобрат — полонина Перці</span>
                                    <div class="calendar-header-center waiting">
                                        <span class="text-sm">Очікує на оплату</span>
                                    </div>
                                    <div class="download"></div>
                                    <i></i>
                                </div>

                                <div class="accordion-inner">
                                    <div class="history">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Дата проведення</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">Сб - Нд, 16 - 17.11.2019</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кількість учасників</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">6 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Діти віком до 6</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">2 особи</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Діти віком від 6 до 12 років</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">5 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Вартість туру</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">3,580 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Знижка за дітей</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">-350 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кінцева вартість</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">3,230 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Завантаження</span>
                                            </div>

                                            <div class="col-6">
                                                <a href="document/document.pdf" download class="download">Акт виконаних робіт</a>
                                                <br>
                                                <a href="document/document.pdf" download class="download">Завантажити інфо-лист</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="btn type-2 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">
                                    <span class="text">23.12.2019</span>
                                    <span class="h4">Тур-відпустка «6 днів у замових Карпатах»</span>
                                    <div class="calendar-header-center paid">
                                        <span class="text-sm">Оплачено</span>
                                    </div>
                                    <div class="download"></div>
                                    <i></i>
                                </div>

                                <div class="accordion-inner">
                                    <div class="history">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Дата проведення</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">Сб - Нд, 16 - 17.11.2019</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кількість учасників</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">6 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кінцева вартість</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">8,450 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Завантаження</span>
                                            </div>

                                            <div class="col-6">
                                                <a href="document/document.pdf" download class="download">Завантажити інфо-лист</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="btn type-1 disabled-btn">Скасувати замовлення</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">
                                    <span class="text">23.12.2019</span>
                                    <span class="h4">Тур-відпустка «6 днів у замових Карпатах»</span>
                                    <div class="calendar-header-center paid">
                                        <span class="text-sm">Оплачено</span>
                                    </div>
                                    <div class="download"></div>
                                    <i></i>
                                </div>

                                <div class="accordion-inner">
                                    <div class="history">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Дата проведення</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">Сб - Нд, 16 - 17.11.2019</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кількість учасників</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">6 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Діти віком до 6</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">2 особи</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Діти віком від 6 до 12 років</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">5 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Вартість туру</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">3,580 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Знижка за дітей</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">-350 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кінцева вартість</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">3,230 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Завантаження</span>
                                            </div>

                                            <div class="col-6">
                                                <a href="document/document.pdf" download class="download">Акт виконаних робіт</a>
                                                <br>
                                                <a href="document/document.pdf" download class="download">Завантажити інфо-лист</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="btn type-2 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer-xs"></div>
                                    <div class="additional-block">
                                        <div>
                                            <div class="text">19.12.2019</div>

                                            <div class="load-more-wrapp">
                                                <div class="text text-md">
                                                    <p>Доброго дня! Прошу Вас внести корективи до замовленого мною туру «6 днів у зимових Карпатах», а саме: зменшити кількість осіб до 4. Нажаль, з нами у відпустку не зможуть відправитись Гаврилюк Олександр</p>
                                                </div>
                                                <div class="more-info" style="display: none;">
                                                    <div class="text text-md">
                                                        <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="show-more">
                                                        <span>Читати більше</span>
                                                        <span>Згорнути</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="text">19.12.2019</div>

                                            <div class="load-more-wrapp">
                                                <div class="text text-md">
                                                    <p>Доброго дня! Прошу Вас внести корективи до замовленого мною туру «6 днів у зимових Карпатах», а саме: зменшити кількість осіб до 4. Нажаль, з нами у відпустку не зможуть відправитись Гаврилюк Олександр</p>
                                                </div>
                                                <div class="more-info" style="display: none;">
                                                    <div class="text text-md">
                                                        <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="show-more">
                                                        <span>Читати більше</span>
                                                        <span>Згорнути</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="text">19.12.2019</div>

                                            <div class="load-more-wrapp">
                                                <div class="text text-md">
                                                    <p>Доброго дня! Прошу Вас внести корективи до замовленого мною туру «6 днів у зимових Карпатах», а саме: зменшити кількість осіб до 4. Нажаль, з нами у відпустку не зможуть відправитись Гаврилюк Олександр</p>
                                                </div>
                                                <div class="more-info" style="display: none;">
                                                    <div class="text text-md">
                                                        <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="show-more">
                                                        <span>Читати більше</span>
                                                        <span>Згорнути</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="add-note">
                                            <div class="add-note-toggle">
                                                <div class="add-note-input">
                                                    <label>
                                                        <i>Введіть текст примітки...</i>
                                                        <textarea name="notes" rows="3"></textarea>
                                                    </label>
                                                </div>
                                                <div class="add-note-btns">
                                                    <span class="btn type-2">Надіслати</span>
                                                    <span class="text-sm add-note-btn-cancel"><b class="text-bold">Скасувати</b></span>
                                                </div>
                                            </div>
                                            <span class="add-note-btn text text-sm"><b class="text-bold">Додати примітку</b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">
                                    <span class="text">23.12.2019</span>
                                    <span class="h4">Манява — Драгобрат — полонина Перці</span>
                                    <div class="calendar-header-center waiting">
                                        <span class="text-sm">Очікує скасування</span>
                                    </div>
                                    <div class="download"></div>
                                    <i></i>
                                </div>

                                <div class="accordion-inner">
                                    <div class="history">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Дата проведення</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">Сб - Нд, 16 - 17.11.2019</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кількість учасників</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">6 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кінцева вартість</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">8,450 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Завантаження</span>
                                            </div>

                                            <div class="col-6">
                                                <a href="document/document.pdf" download class="download">Завантажити інфо-лист</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-sm cancel-tour-btn open-popup" data-rel="tour-cancel-popup"><b class="text-bold">Скасувати замовлення</b></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">
                                    <span class="text">23.12.2019</span>
                                    <span class="h4">Манява — Драгобрат — полонина Перці</span>
                                    <div class="calendar-header-center canceled">
                                        <span class="text-sm">Скасовано</span>
                                    </div>
                                    <div class="download"></div>
                                    <i></i>
                                </div>

                                <div class="accordion-inner">
                                    <div class="history">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Дата проведення</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">Сб - Нд, 16 - 17.11.2019</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кількість учасників</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">6 осіб</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Кінцева вартість</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-sm">8,450 грн</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span class="text-sm">Завантаження</span>
                                            </div>

                                            <div class="col-6">
                                                <a href="document/document.pdf" download class="download">Завантажити інфо-лист</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="btn type-1 disabled-btn">Скасувати замовлення</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- TAB #2 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
