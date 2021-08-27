@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.tourist-tabs')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #4 -->
                    <div class="tab active" id="favorites">
                        <h2 class="h2">Улюблені</h2>
                        <hr>
                        <div class="thumb-wrap row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="thumb">
                                    <div class="like active">
                                        <svg width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.079.888C11.464.296 10.616 0 9.532 0c-.3 0-.606.051-.918.154a3.73 3.73 0 00-.87.415c-.268.175-.5.338-.693.49a6.664 6.664 0 00-.551.488 6.678 6.678 0 00-.551-.487 9.296 9.296 0 00-.693-.49 3.736 3.736 0 00-.87-.416A2.927 2.927 0 003.467 0C2.384 0 1.536.296.92.888.307 1.48 0 2.301 0 3.352c0 .32.057.649.17.988.114.339.244.628.389.866.145.239.31.472.493.699.184.226.318.383.403.469.084.086.15.148.199.186l4.527 4.311A.437.437 0 006.5 11a.437.437 0 00.32-.129l4.519-4.297C12.446 5.481 13 4.407 13 3.351c0-1.05-.307-1.871-.921-2.463z"/></svg>
                                    </div>
                                    <div class="thumb-img">
                                        <div class="label">новинка</div>
                                        <img src="{{asset('img/preloader.png')}}" data-img-src="img/tour_1.jpg" alt="tour 1">
                                        <a href="tour.php" class="full-size"></a>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="title h3">
                                            <a href="tour.php">Манява — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected">
											<i class="select-icon icon-star-empty"></i>
											<i class="select-icon icon-star-empty"></i>
											<i class="select-icon icon-star-empty"></i>
											<i class="select-icon icon-star-empty"></i>
											<i class="select-icon icon-star-empty"></i>
											<span class="text">Немає відгуків</span>
										</span>
                                        <div class="datepicker-input">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-info">
                                            <span class="thumb-info-time text">2д / 1н</span>
                                            <span class="thumb-info-people text">10+</span>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                        </div>
                                        <a href="tour.php" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                    <div class="thumb-desc text">
                                        <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="tour.php" class="btn btn-read-more text-bold">Більше</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="thumb">
                                    <div class="like active">
                                        <svg width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.079.888C11.464.296 10.616 0 9.532 0c-.3 0-.606.051-.918.154a3.73 3.73 0 00-.87.415c-.268.175-.5.338-.693.49a6.664 6.664 0 00-.551.488 6.678 6.678 0 00-.551-.487 9.296 9.296 0 00-.693-.49 3.736 3.736 0 00-.87-.416A2.927 2.927 0 003.467 0C2.384 0 1.536.296.92.888.307 1.48 0 2.301 0 3.352c0 .32.057.649.17.988.114.339.244.628.389.866.145.239.31.472.493.699.184.226.318.383.403.469.084.086.15.148.199.186l4.527 4.311A.437.437 0 006.5 11a.437.437 0 00.32-.129l4.519-4.297C12.446 5.481 13 4.407 13 3.351c0-1.05-.307-1.871-.921-2.463z"/></svg>
                                    </div>
                                    <div class="thumb-img">
                                        <div class="label">новинка</div>
                                        <img src="{{asset('img/preloader.png')}}" data-img-src="img/tour_2.jpg" alt="tour 2">
                                        <a href="tour.php" class="full-size"></a>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="title h3">
                                            <a href="tour.php">Тур-відпустка «6 днів у замових Карпатах»</a>
                                        </div>
                                        <span class="stars select-stars stars-selected">
											<i class="select-icon icon-star"></i>
											<i class="select-icon icon-star"></i>
											<i class="select-icon icon-star"></i>
											<i class="select-icon icon-star"></i>
											<i class="select-icon icon-star-empty"></i>
											<span class="text">14 відгуків</span>
										</span>
                                        <div class="datepicker-input">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-info">
                                            <span class="thumb-info-time text">2д / 1н</span>
                                            <span class="thumb-info-people text">0 <span class="tooltip-wrap black"><span class="tooltip text text-sm light">0 людей</span></span></span>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>2595</span><i>грн</i></span>
                                        </div>
                                        <a href="tour.php" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                    <div class="thumb-desc text">
                                        <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="tour.php" class="btn  btn-read-more text-bold">Більше</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- TAB #4 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection

