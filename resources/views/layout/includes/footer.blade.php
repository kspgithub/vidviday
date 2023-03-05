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
                                            <a href="{{$menuChildren->url}}" class="text">{{$menuChildren->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($loop->last)
                            <x-seo-button :code="'goto.blog'" href="{{pageUrlByKey('blog')}}"
                               class="btn type-3 btn-more text-md">{{__('footer-section.blog')}}</x-seo-button>
                        @endif
                    </div>
                @endforeach

                @if(!is_tour_agent() && isset($tourManager) && $tourManager)
                    <div class="col-12 only-print footer-manger">
                        <span class="text-md text-medium">@lang('tours-section.tour-manager')</span>
                        <div class="spacer-xs"></div>
                        <span>{{$tourManager->name}}</span>
                        <div class="spacer-xs"></div>
                        <div class="contact no-padding">
                            @foreach($tourManager->phones as $phone)
                                <a href="tel:{{clear_phone($phone)}}" class="text" target="_blank">{{$phone}}</a>
                                <br>
                            @endforeach
                            @if($tourManager->email)
                                <div class="spacer-xs"></div>
                                <a href="mailto:{{$tourManager->email}}" class="text" target="_blank">{{$tourManager->email}}</a>
                            @endif
                        </div>
                        @if($tourManager->viber)
                            <div class="contact">
                                <div class="img">{{svg('viber')}}</div>
                                <a href="{{viber_link($tourManager->viber)}}" target="_blank">{{$tourManager->viber}}</a>
                            </div>
                        @endif
                        @if($tourManager->telegram)
                            <div class="contact">
                                <div class="img">
                                    {{svg('telegram')}}
                                </div>
                                <a href="{{tg_link($tourManager->telegram)}}"
                                   target="_blank">{{$tourManager->telegram}}</a>
                            </div>
                        @endif
                        @if($tourManager->whatsapp)
                            <div class="contact">
                                <div class="img">
                                    {{svg('whatsapp')}}
                                </div>
                                <a href="{{whatsapp_link($tourManager->whatsapp)}}"
                                   target="_blank">{{$tourManager->whatsapp}}</a>
                            </div>
                        @endif
                        @if(!empty($tourManager->additional))
                            <div>
                                {!! $tourManager->additional !!}
                            </div>
                        @endif
                    </div>
                @endif


                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <x-seo-button :code="'goto.contacts'" href="{{route('contacts')}}"
                               class="btn type-3 btn-more text-md">{{__('footer-section.contacts')}}</x-seo-button>
                        </div>
                        <div class="accordion-inner">
                            <div class="contact">
                                <div class="img">
                                    {{svg('tel')}}
                                </div>
                                <a href="{{phone_link($contact->work_phone)}}">{{$contact->work_phone}}</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    {{svg('smartphone')}}
                                </div>
                                <a href="{{phone_link($contact->phone_1)}}">{{$contact->phone_1}}</a>
                                <br>
                                <a href="{{phone_link($contact->phone_2)}}">{{$contact->phone_2}}</a>
                                <br>
                                <a href="{{phone_link($contact->phone_3)}}">{{$contact->phone_3}}</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    {{svg('mail')}}
                                </div>
                                <a href="{{mail_link($contact->email)}}">{{$contact->email}}</a>
                            </div>

                            <div class="social style-2">
                                @foreach(social_contacts($contact) as $key => $social)
                                    <a target="_blank" href="{{$social['href']}}">
                                        {{svg($social['svg-icon'])}}
                                    </a>
                                @endforeach
                            </div>

                            <x-seo-button :code="'order.call'" class="btn type-1"
                                  v-is="'popup-call-btn'">{{__('footer-section.order-call')}}</x-seo-button>
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
                            <div class="only-print">
                                <div class="contact">
                                    <div class="img">
                                        {{svg('plane')}}
                                    </div>
                                    www.vidviday.ua
                                </div>
                            </div>



                            <x-seo-button :code="'goto.map'" href="{{$showOnMapUrl}}" class="btn type-3 btn-more text-md text-uppercase hidden-print">
                                {{__('footer-section.show-on-map')}}
                            </x-seo-button>
                        </div>
                    </div>

                    <div class="accordion-item hidden-print">
                        <div class="accordion-title">
                            <span class="text-md">{{__('footer-section.suggestions')}}</span>
                        </div>
                        <div class="accordion-inner">
                            <div class="img">
                                <img loading="lazy" src="{{asset('img/preloader.png')}}" data-img-src="{{$complaintsImage}}"
                                     alt="user">
                            </div>
                            <x-seo-button :code="'question.send'" class="btn type-2"
                                  v-is="'popup-email-btn'">{{__('footer-section.write-message')}}</x-seo-button>
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

                        @foreach(config('contacts.social-links') as $social)
                            <a href="{{$social['href']}}" target="_blank">
                                {{svg($social['svg-icon'])}}
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
