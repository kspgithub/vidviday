<div class="section">
    <!-- BANNER TABS -->
    @include('contact.includes.banner-tabs', ['pictures'=>$pageContent->getMedia()])
    <!-- BANNER TABS END -->
    <div class="spacer-xs"></div>
    <h1 class="h1 title">{{!empty($pageContent->seo_h1) ? $pageContent->seo_h1 : $pageContent->title}}</h1>
    <div class="spacer-xxs"></div>
    <div class="only-pad-mobile">
        <x-sidebar.social-share :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
        <div class="spacer-xs"></div>
    </div>
    <div class="text text-md">
        <p>{!! $pageContent->text !!}</p>
    </div>
    <div class="spacer-xs"></div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="contacts-block">
                <span class="text-md">Телефонуйте</span>
                <div class="contact">
                    <div class="img">
                        {{svg('tel')}}
                    </div>
                    <a href="tel:{{clear_phone($contact->work_phone)}}">{{$contact->work_phone}}</a>
                </div>

                <div class="contact">
                    <div class="img">
                        {{svg('smartphone')}}
                    </div>
                    <a href="tel:{{clear_phone($contact->phone_1)}}">{{$contact->phone_1}}</a>
                    <br>
                    <a href="tel:{{clear_phone($contact->phone_2)}}">{{$contact->phone_2}}</a>
                    <br>
                    <a href="tel:{{clear_phone($contact->phone_3)}}">{{$contact->phone_3}}</a>
                </div>

                <span class="btn type-2" v-is="'popup-call-btn'">{{__('common.order-call')}}</span>
            </div>

            <div class="contacts-block">
                <span class="text-md">Пишіть</span>
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
                <div class="spacer-xxs only-pad-mobile"></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="contacts-block">
                <span class="text-md">{{__('common.location')}}</span>

                <div class="contact">
                    <div class="img">
                        {{svg('placeholder')}}
                    </div>
                    <span class="text-md">{{$contact->address}}</span>
                    <span class="text-sm">{{$contact->address_comment}}</span>
                </div>

                <div class="contact">
                    <div class="img">
                        {{svg('plane')}}
                    </div>
                    <a href="geo:{{$contact->lat}}, {{$contact->lng}}">{{$contact->lat}}, {{$contact->lng}}</a>
                </div>
            </div>

            <div class="contacts-block">
                <span class="text-md">{{__('common.work-time')}}</span>

                <div class="contact">
                    <div class="img">
                        {{svg('time')}}
                    </div>
                    <span>{{$contact->opening_hours}}</span>
                </div>
            </div>
        </div>
        @include('contact.includes.form')
    </div>
    <div class="spacer-xs"></div>
</div>
