@extends("layout.app")

@section("title") {{ __("Vidviday | Faq") }} @endsection


@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{ route("home") }}">{{ __("Головна") }}</a>
                <span>—</span>
                <span>{{ __("Є питання?") }}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-12 only-pad-mobile">
                    <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img src="{{ __("img/preloader.png") }}" data-img-src="icon/filter-dark.svg" alt="filter-dark">{{ __("Підбір туру") }}</span>
                    <div class="spacer-xs"></div>
                </div>
                <div class="col-xl-8 col-12">
                    <!-- FAQ CONTENT -->
                    <h1 class="h1 title">{{ __("20 основних питань і відповідей щодо успішної співпраці ТО «Відвідай» з партнерами (турагентами)") }}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <div class="social">
                            <span>Поділитись:</span>
                            <div class="share dropdown">
                                <div class="icon">
                                    <div class="dropdown-btn full-size"></div>
                                </div>
                                <div class="dropdown-toggle">
                                    <div class="social style-1">
                                        <a href="https://www.facebook.com/vidviday">
                                            <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z" fill="#4267B2"/></svg>
                                        </a>

                                        <a href="https://twitter.com/vidviday">
                                            <svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z" fill="#179CDE"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        <p>{{ __("Якщо Вам сподобалися наші тури, то Ви із задоволенням можете продавати їх Вашим туристам. Співпраця з нами дуже проста. Нижче наводимо відповіді на найпопулярніші питання.") }}</p>
                    </div>
                    <div class="spacer-xs"></div>
                    <hr>
                    <div class="spacer-xs"></div>

                    <div class="tabs faqs">
                        <div class="tab-nav faq-tab-nav">
                            <ul class="tab-toggle">

                                <li class="tab-caption active">
                                    <span>{{ __("Загальні запитання") }}</span>
                                </li>

                                <li class="tab-caption">
                                    <span>{{ __("Туристичні запитання") }}</span>
                                </li>

                                <li class="tab-caption">
                                    <span>{{ __("Запитання тур-аґенту") }}</span>
                                </li>

                                <li class="tab-caption">
                                    <span>{{ __("Корпоративні запитання") }}</span>
                                </li>

                                <li class="tab-caption">
                                    <span>{{ __("Запит, щодо сертифікатів") }}</span>
                                </li>

                            </ul>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="tabs-wrap">

                            <!-- TAB #1 -->
                            <div class="tab active">
                                <div class="accordion-all-expand">
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>

                                    <div class="accordion type-5">

                                        @foreach(faqBySection("common") as $item)

                                            @if($loop->first)
                                                <div class="accordion-item active">
                                                    <div class="accordion-title"><b>{{ $loop->iteration > 9 ? $loop->iteration : "0".$loop->iteration }}.</b>{{ $item->question }}<i></i></div>
                                                    <div class="accordion-inner" style="display: block;">
                                                        <div class="text text-md">
                                                            <p>{{ $item->answer }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else

                                                <div class="accordion-item">
                                                    <div class="accordion-title"><b>{{ $loop->iteration > 9 ? $loop->iteration : "0".$loop->iteration }}.</b>{{ $item->question }}<i></i></div>
                                                    <div class="accordion-inner">
                                                        <div class="text text-md">
                                                            <p> {{ $item->answer }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB #1 END -->

                            <!-- TAB #2 -->
                            <div class="tab">
                                <div class="accordion-all-expand">
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>
                                    <div class="accordion type-5">

                                        @foreach(faqBySection("tourist") as $item)

                                            <div class="accordion-item">
                                                <div class="accordion-title"><b>{{ countQuestion($loop->iteration, "common") > 9 ? countQuestion($loop->iteration, "common") : "0".countQuestion($loop->iteration, "common")  }}.</b>{{ $item->question }}<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <p>{{ $item->answer }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="expand-all-button">
                                        <div class="expand-all">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all up">{{ __("Згорнути все") }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB #2 END -->

                            <!-- TAB #3 -->
                            <div class="tab">
                                <div class="accordion-all-expand">
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>
                                    <div class="accordion type-5">

                                        @foreach(faqBySection("tour-agent") as $item)

                                            <div class="accordion-item">
                                                <div class="accordion-title"><b>{{ countQuestion($loop->iteration, "common", "tourist") > 9 ? countQuestion($loop->iteration, "common", "tourist") : "0".countQuestion($loop->iteration, "common","tourist")  }}.</b>{{ $item->question }}<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <p>{{ $item->answer }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="expand-all-button">
                                        <div class="expand-all">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all up">{{ __("Згорнути все") }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB #3 END -->

                            <!-- TAB #4 -->
                            <div class="tab">
                                <div class="accordion-all-expand">
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>
                                    <div class="accordion type-5">

                                        @foreach(faqBySection("corporate") as $item)

                                            <div class="accordion-item">
                                                <div class="accordion-title"><b>{{ countQuestion($loop->iteration, "common","tourist", "tour-agent") > 9 ? countQuestion($loop->iteration, "common","tourist", "tour-agent") : "0".countQuestion($loop->iteration, "common","tourist", "tour-agent")  }}.</b>{{ $item->question }}<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <p>{{ $item->answer }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="expand-all-button">
                                        <div class="expand-all">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all up">{{ __("Згорнути все") }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB #5 END -->

                            <!-- TAB #5 -->
                            <div class="tab">
                                <div class="accordion-all-expand">
                                    <div class="expand-all-button">
                                        <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                    </div>
                                    <div class="accordion type-5">

                                        @foreach(faqBySection("certificate") as $item)

                                            <div class="accordion-item">
                                                <div class="accordion-title"><b>{{ countQuestion($loop->iteration, "common", "corporate", "tourist", "tour-agent") > 9 ? countQuestion($loop->iteration, "common", "corporate", "tourist", "tour-agent") : "0".countQuestion($loop->iteration, "common", "corporate", "tourist", "tour-agent")  }}.</b>{{ $item->question }}<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <p>{{ $item->answer }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="expand-all-button">
                                        <div class="expand-all">{{ __("Розгорнути все") }}</div>
                                        <div class="expand-all up">{{ __("Згорнути все") }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- TAB #5 END -->

                        </div>
                    </div>
                    <!-- FAQ CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                      @include("faq.includes.sidebar")
                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>

            <div id="tour-selection-dropdown" class="sidebar-item selection-tour notice only-pad-mobile">
                <div class="top-part">
                    <div class="title h3 light title-icon"><img src="img/preloader.png" data-img-src="icon/filter.svg" alt="filter">Підбір туру</div>
                    <div class="btn-close light">
                        <span></span>
                    </div>
                </div>
                <div class="bottom-part">
                    <form action="/">
                        <div class="double-datepicker">
                            <div class="datepicker-input date-departure">
                                <span class="datepicker-placeholder">Дата виїзду</span>
                                <div class="datepicker-toggle">
                                    <div class="datepicker-here" data-language="uk"></div>
                                </div>
                            </div>

                            <div class="datepicker-input date-arrival">
                                <span class="datepicker-placeholder">Дата Приїзду</span>
                                <div class="datepicker-toggle">
                                    <div class="datepicker-here" data-language="uk"></div>
                                </div>
                            </div>
                        </div>

                        <div class="range">
                            <label for="days-amount">Тривалість днів</label>
                            <input type="text" id="days-amount" readonly>
                            <div class="slider-range" data-min="1" data-max="14" data-values="[1, 14]"></div>
                            <div class="text">
                                <span>від <span class="range-min">1</span></span>
                                <span>до <span class="range-max">14</span></span>
                            </div>
                        </div>

                        <div class="range">
                            <label for="price">Вартість, грн</label>
                            <input type="text" id="price" readonly>
                            <div class="slider-range" data-min="0" data-max="3000" data-values="[0, 3000]"></div>
                            <div class="text">
                                <span>від <span class="range-min">0</span></span>
                                <span>до <span class="range-max">3000</span></span>
                            </div>
                        </div>

                        <select name="direction">
                            <option value="location_0" selected disabled>Напрямок</option>
                            <option value="location_1">Напрямок 1</option>
                            <option value="location_2">Напрямок 2</option>
                            <option value="location_3">Напрямок 3</option>
                            <option value="location_4">Напрямок 4</option>
                            <option value="location_5">Напрямок 5</option>
                            <option value="location_6">Напрямок 6</option>
                            <option value="location_7">Напрямок 7</option>
                            <option value="location_8">Напрямок 8</option>
                        </select>

                        <select name="type">
                            <option value="type_0" selected disabled>Тип</option>
                            <option value="type_1">Тип 1</option>
                            <option value="type_2">Тип 2</option>
                            <option value="type_3">Тип 3</option>
                            <option value="type_4">Тип 4</option>
                            <option value="type_5">Тип 5</option>
                            <option value="type_6">Тип 6</option>
                        </select>

                        <select name="topic">
                            <option value="0" selected disabled>Тематика</option>
                            <option value="topic_1">Тематика 1</option>
                            <option value="topic_2">Тематика 2</option>
                            <option value="topic_3">Тематика 3</option>
                            <option value="topic_4">Тематика 4</option>
                            <option value="topic_5">Тематика 5</option>
                            <option value="topic_6">Тематика 6</option>
                            <option value="topic_7">Тематика 7</option>
                        </select>
                        <span class="btn type-3">Очистити</span>
                        <span class="btn type-1">Підібрати</span>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO TEXT -->
           @include("faq.includes.seo-text")
        <!-- SEO TEXT END -->
    </main>

@endsection
