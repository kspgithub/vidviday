<div class="section">
    <!-- BANNER TABS -->
    <div class="banner-tabs tabs">
        <div class="tabs-nav">
            <span class="tab-title"></span>
            <ul class="tab-toggle">
                <li class="tab-caption active"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/photo.svg')}}" alt="placeholder light">Фото</li>
            </ul>
        </div>
        <div class="tabs-wrap">
            <!-- TAB #1 -->
            <div class="tab active">
                <div class="banner-carousel">
                    <div class="swiper-entry">
                        <div class="swiper-button-prev">
                            <i></i>
                        </div>
                        <div class="swiper-button-next">
                            <i></i>
                        </div>
                        <div class="swiper-container" data-options='{"lazy": true, autoHeight": true, "parallax": true, "speed": 900}'>
                            <div class="swiper-wrapper lightbox-wrap">
                                <div class="swiper-slide">
                                    <img src="{{asset('img/preloader.png')}}" data-src="{{$pageContent->media}}" alt="{{$pageContent->seo_title ?? $pageContent->title}}" data-swiper-parallax="30%" class="swiper-lazy">
                                    <div class="swiper-lazy-preloader"></div>
                                    <div class="full-size">
                                        <span>Наша команда</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination light"></div>
                    </div>
                </div>
            </div>
            <!-- TAB #1 END -->
        </div>
    </div>
    <!-- BANNER TABS END -->
    <div class="spacer-xs"></div>
    <h1 class="h1 title">{{$pageContent->seo_title ?? $pageContent->title}}</h1>
    <div class="spacer-xxs"></div>
    <div class="only-pad-mobile">
        @include('staff.includes.social-share')
        <div class="spacer-xs"></div>
    </div>
    <div class="text text-md">
        <p>{!! $pageContent->text !!}</p>
    </div>
    <div class="spacer-xs"></div>
    <div class="row">
        @foreach($contacts as $contact)
        <div class="col-lg-4 col-md-6 col-12">
            <div class="contacts-block">
                <span class="text-md">Телефонуйте</span>
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/tel.svg')}}" alt="tel">
                    </div>
                    <a href="tel:+380322553655">{{$contact->work_phone}}</a>
                </div>

                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/smartphone.svg')}}" alt="smartphone">
                    </div>
                    <a href="tel:{{$contact->phone_1}}">{{$contact->phone_1}}</a>
                    <br>
                    <a href="tel:{{$contact->phone_2}}">{{$contact->phone_2}}</a>
                    <br>
                    <a href="tel:{{$contact->phone_3}}">{{$contact->phone_3}}</a>
                </div>

                <span class="btn type-2 open-popup" data-rel="call-back-popup">Замовити дзвінок</span>
            </div>

            <div class="contacts-block">
                <span class="text-md">Пишіть</span>
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/mail.svg')}}" alt="mail">
                    </div>
                    <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                </div>
                <div class="social style-2">
                    @if ( !empty($contact->skype))
                    <a href="skype:{{$contact->skype}}?call">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.645 10.105c0 .693-.076 1.366-.22 2.018A5.37 5.37 0 0120 14.545C20 17.558 17.524 20 14.468 20c-.947 0-1.837-.39-2.616-.803a9.735 9.735 0 01-1.746.158c-5.269 0-9.54-4.055-9.54-9.25 0-.648.067-1.28.194-1.89A5.38 5.38 0 010 5.454C0 2.442 2.476 0 5.533 0c1.081 0 2.09.307 2.942.837A9.739 9.739 0 0110.106.7c5.27 0 9.54 4.211 9.54 9.405zm-6.804 5.068c.71-.295 1.248-.707 1.616-1.23a3.013 3.013 0 00.552-1.77c0-.549-.107-1.012-.319-1.39a2.674 2.674 0 00-.886-.939 5.777 5.777 0 00-1.379-.63 19.35 19.35 0 00-1.808-.474 31.12 31.12 0 01-1.145-.28 3.823 3.823 0 01-.684-.269 1.562 1.562 0 01-.532-.407.87.87 0 01-.194-.563c0-.35.19-.651.569-.9.379-.25.878-.374 1.494-.374.667 0 1.15.114 1.45.344.302.23.559.55.774.96.166.287.32.493.463.619.142.125.35.19.625.19.3 0 .552-.106.753-.316a.999.999 0 00.301-.709c0-.285-.08-.581-.242-.881-.16-.302-.416-.59-.765-.864-.349-.274-.787-.494-1.316-.66-.53-.165-1.157-.248-1.882-.248-.907 0-1.697.125-2.369.375-.672.25-1.184.606-1.539 1.071a2.551 2.551 0 00-.531 1.594c0 .627.167 1.152.503 1.575.335.422.79.755 1.362 1 .572.244 1.282.46 2.13.641.635.133 1.142.26 1.52.379.379.118.687.29.927.515.239.223.359.517.359.877 0 .454-.223.835-.665 1.138-.444.304-1.02.456-1.73.456-.514 0-.931-.076-1.249-.226a1.94 1.94 0 01-.736-.575 4.225 4.225 0 01-.488-.868c-.123-.291-.272-.51-.447-.659a.95.95 0 00-.64-.223c-.311 0-.568.095-.77.287a.907.907 0 00-.301.684c0 .46.168.934.503 1.42.336.487.773.877 1.31 1.168.757.405 1.719.608 2.884.608.972 0 1.812-.148 2.522-.446z" fill="#0193E0"/></svg>
                    </a>
                    @endif
                    @if ( !empty($contact->viber))
                    <a href="{{$contact->viber}}?chat">
                        <svg width="20" height="22" viewBox="0 0 20 22" xmlns="http://www.w3.org/2000/svg"><path d="M19.796 12.736c.65-5.52-.313-9.005-2.051-10.58v-.002C14.94-.537 5.466-.936 2.11 2.275.602 3.845.071 6.151.013 9.005c-.058 2.855-.127 8.202 4.819 9.653h.005l-.005 2.215s-.034.898.535 1.078c.651.213.946-.204 2.97-2.64 3.386.296 5.986-.382 6.281-.48.684-.232 4.552-.747 5.178-6.095zM8.67 17.752s-2.143 2.692-2.809 3.39c-.218.228-.457.207-.454-.244 0-.296.017-3.678.017-3.678-4.194-1.21-3.947-5.764-3.901-8.146.045-2.383.478-4.335 1.754-5.65C6.223.645 14.53 1.266 16.646 3.27c2.587 2.31 1.666 8.839 1.671 9.061-.531 4.464-3.666 4.747-4.242 4.94-.247.083-2.533.675-5.404.482z" fill="#7D3DAF"/><path d="M9.857 3.948c-.35 0-.35.55 0 .554 2.715.02 4.952 1.928 4.976 5.425 0 .37.536.365.532-.004-.03-3.77-2.472-5.954-5.508-5.975z" fill="#7D3DAF"/><path d="M13.428 9.347c-.008.365.528.382.532.013.045-2.078-1.227-3.79-3.617-3.97-.35-.026-.386.528-.037.554 2.072.159 3.164 1.584 3.122 3.403zM12.856 11.711c-.45-.262-.907-.099-1.096.159l-.395.515c-.201.262-.577.228-.577.228-2.74-.73-3.472-3.62-3.472-3.62s-.034-.39.217-.6l.494-.412c.248-.198.404-.674.152-1.142-.672-1.225-1.124-1.647-1.354-1.971-.242-.305-.606-.374-.984-.168h-.008c-.786.464-1.647 1.331-1.372 2.224.47.942 1.334 3.943 4.086 6.21 1.294 1.073 3.341 2.172 4.21 2.426l.009.012c.856.288 1.689-.613 2.133-1.43v-.005c.198-.395.132-.769-.156-1.014-.511-.501-1.282-1.055-1.887-1.412z" fill="#7D3DAF"/><path d="M10.717 7.434c.874.052 1.298.511 1.343 1.456.016.369.548.343.532-.026-.058-1.233-.696-1.92-1.846-1.984-.35-.02-.382.533-.029.554z" fill="#7D3DAF"/></svg>
                    </a>
                    @endif
                    @if ( !empty($contact->telegram))
                    <a href="@{{$contact->telegram}}">
                        <svg width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg"><path d="M.353 8.63l4.609 1.779 1.783 5.93c.115.38.564.52.862.268l2.569-2.165a.747.747 0 01.934-.027l4.633 3.477c.32.24.771.06.851-.34L19.988.678c.088-.436-.326-.799-.727-.638L.348 7.58c-.467.187-.463.87.005 1.05zm6.105.832l9.006-5.734c.162-.102.329.124.19.257L8.22 11.127c-.261.252-.43.588-.478.953l-.253 1.94a.231.231 0 01-.454.034l-.974-3.537a.952.952 0 01.396-1.055z" fill="#179CDE"/></svg>
                    </a>
                    @endif
                    @if ( !empty($contact->whatsapp))
                    <a href="{{$contact->whatsapp}}">
                        <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.997 0h.006C17.068 0 22 4.935 22 11s-4.932 11-10.997 11c-2.237 0-4.312-.666-6.052-1.818L.723 21.534l1.371-4.087A10.919 10.919 0 010 11C0 4.934 4.932 0 10.997 0zm4.248 17.086c.84-.182 1.893-.803 2.158-1.553.266-.75.266-1.39.189-1.526-.062-.108-.21-.179-.429-.284l-.186-.091c-.323-.161-1.895-.938-2.192-1.041-.291-.11-.569-.072-.789.24l-.125.175c-.265.373-.521.733-.734.963-.194.206-.51.232-.776.122a8.428 8.428 0 00-.099-.04c-.42-.17-1.352-.547-2.48-1.55-.952-.848-1.598-1.902-1.785-2.219-.184-.317-.025-.503.121-.675l.008-.01c.095-.116.186-.213.278-.311.066-.07.133-.141.2-.22l.03-.033c.144-.166.23-.265.327-.47.11-.214.031-.434-.047-.596-.054-.114-.387-.922-.673-1.616l-.315-.764c-.214-.51-.376-.53-.699-.543l-.03-.002a6.505 6.505 0 00-.338-.01c-.421 0-.86.123-1.125.394l-.03.03C5.366 5.8 4.61 6.57 4.61 8.102c0 1.536 1.09 3.023 1.292 3.298l.014.02.069.097c.411.596 2.417 3.5 5.408 4.74 2.527 1.048 3.278.95 3.853.828z" fill="#4CAF50"/></svg>
                    </a>
                    @endif
                    @if ( !empty($contact->messenger))
                    <a href="{{$contact->messenger}}">
                        <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg"><path d="M4.13 22c-.323 0-.645-.088-.931-.264a1.745 1.745 0 01-.841-1.497v-2.578C.504 15.331-.298 12.42.099 9.432.737 4.64 4.707.712 9.54.093c3.404-.436 6.745.67 9.17 3.035a10.842 10.842 0 013.221 9.033c-.549 4.89-4.529 8.913-9.463 9.566a11.068 11.068 0 01-5.783-.787l-1.76.873A1.788 1.788 0 014.13 22zM9.74 1.64c-4.138.53-7.537 3.893-8.083 7.996-.352 2.647.39 5.222 2.09 7.25.118.14.182.317.182.499v2.854c0 .092.052.143.096.17.044.027.114.05.197.009l2.093-1.037A.79.79 0 017 19.372a9.495 9.495 0 005.258.81c4.23-.56 7.64-4.005 8.11-8.193a9.3 9.3 0 00-2.76-7.749c-2.079-2.027-4.947-2.975-7.868-2.6z" fill="#1976D2"/><path d="M5.54 13.378l3.606-5.093a.505.505 0 01.74-.151L12.3 9.93a.507.507 0 00.561.029l2.942-2.063c.432-.257.934.204.71.651l-2.913 5a.505.505 0 01-.71.205l-3.225-1.92a.507.507 0 00-.484-.019l-2.98 2.258c-.446.221-.91-.265-.662-.694z" fill="#1976D2"/></svg>
                    </a>
                    @endif
                </div>
                <div class="spacer-xxs only-pad-mobile"></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="contacts-block">
                <span class="text-md">Розташування</span>

                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/placeholder.svg')}}" alt="placeholder">
                    </div>
                    <span class="text-md">{{$contact->address}}</span>
                    <span class="text-sm">{{$contact->address_coment}}</span>
                </div>

                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/plane.svg')}}" alt="plane">
                    </div>
                    <a href="geo:{{$contact->lat}}, {{$contact->lng}}">{{$contact->lat}}, {{$contact->lng}}</a>
                </div>
            </div>

            <div class="contacts-block">
                <span class="text-md">Графік роботи</span>

                <div class="contact">
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/time.svg')}}" alt="time">
                    </div>
                    <span>{{$contact->opening_hours}}</span>
                </div>
            </div>
        </div>
        @endforeach
        @include('contact.includes.form')
    </div>
    <div class="spacer-xs"></div>
</div>
