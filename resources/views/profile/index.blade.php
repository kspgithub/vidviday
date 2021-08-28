@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.tourist-tabs')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #1 -->
                    <div class="tab active" id="info">
                        <div class="only-desktop-pad">
                            <h1 class="h2">Особисті дані</h1>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-xl-8 col-12">
                                <form action="/" class="row">
                                    <div class="col-12">
                                        <span class="h4">Фото користувача</span>
                                        <div class="spacer-xs"></div>
                                        <div class="img-input-wrap">
                                            <div class="img">
                                                <img src="{{asset('img/preloader.png')}}" data-img-src="img/avatar.jpg" alt="avatar.jpg">
                                            </div>
                                            <label class="img-input btn type-2">Змінити фото<input type="file" class="full-size"></label>
                                        </div>
                                        <div class="spacer-sm"></div>
                                    </div>

                                    <div class="col-12">
                                        <span class="h4">Персональні дані</span>
                                    </div>

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
                                        <label data-tooltip="Поле обов’язкове до заповнення">
                                            <i>По-батькові*</i>
                                            <input type="text" name="middle-name" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="single-datepicker">
                                            <div class="datepicker-input">
                                                <span class="datepicker-placeholder">Дата народження*</span>
                                                <div class="datepicker-toggle">
                                                    <div class="datepicker-here" data-language="uk"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label data-tooltip="Поле обов’язкове до заповнення">
                                            <i>Email*</i>
                                            <input type="text" name="email" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label data-tooltip="Поле обов’язкове до заповнення">
                                            <i>Мобільний телефон*</i>
                                            <input type="tel" name="tel" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label>
                                            <i>Viber</i>
                                            <input type="text" name="viber">
                                            <span class="tooltip-wrap light text-center"><span class="tooltip text text-sm">Ваш номер буде додано до турагентської <br>Вайбер-розсилки з акціями, новими турами, даними <br>про наявність місць та іншою корисною інформацією</span></span>
                                        </label>
                                    </div>

                                    <div class="col-12">
                                        <div class="spacer-xs"></div>
                                        <span class="h4">Зареєстровано через</span>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <a href="cabinet-user.php" class="btn type-1 btn-block btn-fb"><svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z"/></svg>Veronika Hryhoryash</a>
                                    </div>

                                    <div class="col-12">
                                        <div class="spacer-xs"></div>
                                        <span class="h4">Пароль</span>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label data-tooltip="Поле обов’язкове до заповнення">
                                            <i>Теперішній пароль*</i>
                                            <input type="password" name="regular-password" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6 col-12"></div>

                                    <div class="col-md-6 col-12">
                                        <label>
                                            <i>Новий пароль</i>
                                            <input type="password" name="new-password">
                                        </label>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label data-tooltip="Поле обов’язкове до заповнення">
                                            <i>Повторіть пароль*</i>
                                            <input type="password" name="repeated-password" required>
                                        </label>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-sm">* обов’язкове для заповнення поле</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-6 col-5">
                                <span class="btn btn-read-more text-bold">Скасувати</span>
                            </div>

                            <div class="col-md-6 col-7 text-right">
                                <span class="btn type-1">Зберегти зміни</span>
                            </div>
                        </div>
                    </div>
                    <!-- TAB #1 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
