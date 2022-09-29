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

                            <a href="{{$showOnMapUrl}}" class="btn type-3 btn-more text-md text-uppercase hidden-print">
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
                                <img src="{{asset('img/preloader.png')}}" data-img-src="{{$complaintsImage}}"
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
