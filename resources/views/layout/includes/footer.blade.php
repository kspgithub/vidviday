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

                @if(!is_tour_agent())
                    
                        <div class="col-12 only-print footer-manger">
                            <span class="text-md text-medium">Менеджер туру</span>
                            <div class="spacer-xs"></div>
                            <span>Христина Чорній</span>
                            <div class="spacer-xs"></div>
                            <div class="contact no-padding"><a href="tel:+380988390952" class="text" target="_blank">+38-(098)-839-09-52</a>
                                <br>
                                <a href="tel:+380636705397" class="text" target="_blank">+38-(063)-670-53-97</a>
                                <br>
                                <div class="spacer-xs"></div>
                                <a href="mailto:vidviday.khrystyna@gmail.com" class="text" target="_blank">vidviday.khrystyna@gmail.com</a>
                            </div>
                            <div class="contact">
                                <div class="img"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" class=""><path d="M19.796 12.736c.65-5.52-.313-9.005-2.051-10.58v-.002C14.94-.537 5.466-.936 2.11 2.275.602 3.845.071 6.151.013 9.005c-.058 2.855-.127 8.202 4.819 9.653h.005l-.005 2.215s-.034.898.535 1.078c.651.213.946-.204 2.97-2.64 3.386.296 5.986-.382 6.281-.48.684-.232 4.552-.747 5.178-6.095zM8.67 17.752s-2.143 2.692-2.809 3.39c-.218.228-.457.207-.454-.244 0-.296.017-3.678.017-3.678-4.194-1.21-3.947-5.764-3.901-8.146.045-2.383.478-4.335 1.754-5.65C6.223.645 14.53 1.266 16.646 3.27c2.587 2.31 1.666 8.839 1.671 9.061-.531 4.464-3.666 4.747-4.242 4.94-.247.083-2.533.675-5.404.482z" fill="#7D3DAF"></path><path d="M9.857 3.948c-.35 0-.35.55 0 .554 2.715.02 4.952 1.928 4.976 5.425 0 .37.536.365.532-.004-.03-3.77-2.472-5.954-5.508-5.975z" fill="#7D3DAF"></path><path d="M13.428 9.347c-.008.365.528.382.532.013.045-2.078-1.227-3.79-3.617-3.97-.35-.026-.386.528-.037.554 2.072.159 3.164 1.584 3.122 3.403zM12.856 11.711c-.45-.262-.907-.099-1.096.159l-.395.515c-.201.262-.577.228-.577.228-2.74-.73-3.472-3.62-3.472-3.62s-.034-.39.217-.6l.494-.412c.248-.198.404-.674.152-1.142-.672-1.225-1.124-1.647-1.354-1.971-.242-.305-.606-.374-.984-.168h-.008c-.786.464-1.647 1.331-1.372 2.224.47.942 1.334 3.943 4.086 6.21 1.294 1.073 3.341 2.172 4.21 2.426l.009.012c.856.288 1.689-.613 2.133-1.43v-.005c.198-.395.132-.769-.156-1.014-.511-.501-1.282-1.055-1.887-1.412z" fill="#7D3DAF"></path><path d="M10.717 7.434c.874.052 1.298.511 1.343 1.456.016.369.548.343.532-.026-.058-1.233-.696-1.92-1.846-1.984-.35-.02-.382.533-.029.554z" fill="#7D3DAF"></path></svg></div>
                                <a href="viber://chat?number=%2B380988390952" target="_blank">+38-(098)-839-09-52</a>
                            </div>
                            <div class="contact">
                                <div class="img"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" class=""><path fill-rule="evenodd" clip-rule="evenodd" d="M10.997 0h.006C17.068 0 22 4.935 22 11s-4.932 11-10.997 11c-2.237 0-4.312-.666-6.052-1.818L.723 21.534l1.371-4.087A10.919 10.919 0 010 11C0 4.934 4.932 0 10.997 0zm4.248 17.086c.84-.182 1.893-.803 2.158-1.553.266-.75.266-1.39.189-1.526-.062-.108-.21-.179-.429-.284l-.186-.091c-.323-.161-1.895-.938-2.192-1.041-.291-.11-.569-.072-.789.24l-.125.175c-.265.373-.521.733-.734.963-.194.206-.51.232-.776.122a8.428 8.428 0 00-.099-.04c-.42-.17-1.352-.547-2.48-1.55-.952-.848-1.598-1.902-1.785-2.219-.184-.317-.025-.503.121-.675l.008-.01c.095-.116.186-.213.278-.311.066-.07.133-.141.2-.22l.03-.033c.144-.166.23-.265.327-.47.11-.214.031-.434-.047-.596-.054-.114-.387-.922-.673-1.616l-.315-.764c-.214-.51-.376-.53-.699-.543l-.03-.002a6.505 6.505 0 00-.338-.01c-.421 0-.86.123-1.125.394l-.03.03C5.366 5.8 4.61 6.57 4.61 8.102c0 1.536 1.09 3.023 1.292 3.298l.014.02.069.097c.411.596 2.417 3.5 5.408 4.74 2.527 1.048 3.278.95 3.853.828z" fill="#4CAF50"></path></svg></div>
                                <a href="https://api.whatsapp.com/send?phone=380988390952" target="_blank">+38-(098)-839-09-52</a>
                            </div>
                        </div>
                   
                @endif


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
                            <div class="only-print">
                                <div class="contact">
                                    <div class="img">
                                        {{svg('plane')}}
                                    </div>
                                    www.vidviday.ua
                                </div>
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
