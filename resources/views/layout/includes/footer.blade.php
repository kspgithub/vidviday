<footer>
    <div class="spacer-sm"></div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                @foreach($menu->items as  $menuItem)
                    <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12 hidden-print">
                        <div class="accordion-item">
                            <div class="accordion-title">
                                <span class="text-md">{{$menuItem->title}}</span>
                            </div>
                            <div class="accordion-inner">
                                <ul>
                                    @foreach($menuItem->children as  $menuChildren)
                                        <li>
                                            <a href="{{$menuChildren->slug}}" class="text">{{$menuChildren->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($loop->last)
                            <a href="{{pageUrlByKey('blog')}}"
                               class="btn type-3 btn-more text-md">{{__('footer-section.blog')}}</a>
                        @endif
                    </div>
                @endforeach


                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a href="{{route('contacts')}}"
                               class="btn type-3 btn-more text-md">{{__('footer-section.contacts')}}</a>
                        </div>
                        <div class="accordion-inner">
                            <div class="contact">
                                <div class="img">
                                    {{svg('tel')}}
                                </div>
                                <a href="tel:{{$contact->work_phone}}">{{$contact->work_phone}}</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    {{svg('smartphone')}}
                                </div>
                                <a href="tel:{{$contact->phone_1}}">{{$contact->phone_1}}</a>
                                <br>
                                <a href="tel:{{$contact->phone_2}}">{{$contact->phone_2}}</a>
                                <br>
                                <a href="tel:{{$contact->phone_3}}">{{$contact->phone_3}}</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    {{svg('mail')}}
                                </div>
                                <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                            </div>

                            <div class="social style-2">
                                @if ( !empty($contact->skype))
                                    <a target="_blank" href="skype:{{$contact->skype}}">
                                        {{svg('icon-skype')}}
                                    </a>
                                @endif
                                @if ( !empty($contact->viber))
                                    <a target="_blank"
                                       href="viber://chat?number={{clear_phone($contact->viber, false)}}">
                                        {{svg('icon-viber')}}
                                    </a>
                                @endif
                                @if ( !empty($contact->telegram))
                                    <a target="_blank" href="https://t.me/{{$contact->telegram}}">
                                        {{svg('icon-telegram')}}
                                    </a>
                                @endif
                                @if ( !empty($contact->whatsapp))
                                    <a target="_blank"
                                       href="https://api.whatsapp.com/send?phone={{clear_phone($contact->whatsapp, false)}}">
                                        {{svg('icon-whatsapp')}}
                                    </a>
                                @endif
                                @if ( !empty($contact->messenger))
                                    <a target="_blank" href="https://m.me/{{$contact->messenger}}">
                                        {{svg('icon-messenger')}}
                                    </a>
                                @endif
                            </div>

                            <span class="btn type-1"
                                  v-is="'popup-call-btn'">{{__('footer-section.order-call')}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <span class="text-md">{{__('footer-section.address')}}</span>
                        </div>
                        <div class="accordion-inner">
                            <div class="contact">
                                <div class="img">
                                    {{svg('placeholder')}}
                                </div>
                                <span>{{$contact->address}}</span>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    {{svg('plane')}}
                                </div>
                                <a href="geo:{{$contact->lat}},{{$contact->lng}}">
                                    GPS: {{$contact->lat}} , {{$contact->lng}}
                                </a>
                            </div>

                            <a href="https://www.google.com.ua/maps/place/%D0%B2%D1%83%D0%BB%D0%B8%D1%86%D1%8F+%D0%97%D0%B0%D0%BC%D0%B0%D1%80%D1%81%D1%82%D0%B8%D0%BD%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0,+34,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+79000/@49.85046,24.0264711,19z/data=!3m1!4b1!4m5!3m4!1s0x473add0bf678163d:0xf262ca160f7d2864!8m2!3d49.8504591!4d24.0270183?hl=uk&authuser=0"
                               target="_blank" class="btn type-3 btn-more text-md text-uppercase hidden-print">
                                {{__('footer-section.show-on-map')}}
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item hidden-print">
                        <div class="accordion-title">
                            <span class="text-md">{{__('footer-section.suggestions')}}</span>
                        </div>
                        <div class="accordion-inner">
                            <div class="img">
                                <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/user.jpg')}}"
                                     alt="user">
                            </div>
                            <span class="btn type-2"
                                  v-is="'popup-email-btn'">{{__('footer-section.write-message')}}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="spacer-sm"></div>
    <div class="footer-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="text-sm">© {{date('Y').' '.__('footer-section.license')}}</div>
                </div>

                <div class="col-xl-4 col-12">
                    <ul>
                        <li>
                            <a href="{{pageUrlByKey('public-offer')}}"
                               class="text">{{__('footer-section.public-offer')}}</a>
                        </li>

                        <li>
                            <a href="{{pageUrlByKey('privacy-policy')}}"
                               class="text">{{__('footer-section.privacy-policy')}}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-xl-4 col-12">
                    <div class="social style-1 text-right">
                        <span>{{__('footer-section.be-with-us')}}</span>
                        <a href="https://www.facebook.com/vidviday" target="_blank">
                            {{svg('social-facebook')}}
                        </a>

                        <a href="https://www.instagram.com/vidviday/" target="_blank">
                            {{svg('social-instagram')}}
                        </a>

                        <a href="https://www.youtube.com/user/vidviday" target="_blank">
                            {{svg('social-youtube')}}
                        </a>

                        <a href="https://t.me/vidviday" target="_blank">
                            {{svg('social-telegram')}}
                        </a>

                        <a href="https://www.tripadvisor.com/Attraction_Review-g295377-d14176633-Reviews-Vidviday-Lviv_Lviv_Oblast.html"
                           target="_blank">
                            {{svg('social-tripadvisor')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
