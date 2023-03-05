<div class="footer">
    <table style="width: 100%;">
        <tbody>
        <tr>
            <td style="vertical-align: top;">
                <div>
                    <div
                        style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 16px; line-height: 20px; margin-bottom: 10px;">
                        {{__('footer-section.contacts')}}
                    </div>
                    <div style="position: relative; padding-left: 30px; margin-bottom: 12px;">
                        <img loading="lazy" data-img-src="{{url(asset('icon/tel.png'))}}" alt="tel"
                             style="max-width: 18px; position: absolute; top: 5px; left: 0;">
                        <a href="{{phone_link($contact->work_phone)}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">
                            {{ $contact->work_phone }}
                        </a>
                    </div>

                    <div style="position: relative; padding-left: 30px; margin-bottom: 12px;">
                        <img loading="lazy" data-img-src="{{url(asset('icon/smartphone.png'))}}" alt="smartphone"
                             style="max-width: 18px; position: absolute; top: 5px; left: 0;">
                        <a href="{{phone_link($contact->phone_1)}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">
                            {{$contact->phone_1}}
                        </a>
                        <br>
                        <a href="{{phone_link($contact->phone_2)}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">
                            {{$contact->phone_2}}
                        </a>
                        <br>
                        <a href="{{phone_link($contact->phone_3)}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">
                            {{$contact->phone_3}}
                        </a>
                    </div>

                    <div style="position: relative; padding-left: 30px; margin-bottom: 12px;">
                        <img loading="lazy" data-img-src="{{url(asset('icon/email.png'))}}" alt="email"
                             style="max-width: 18px; position: absolute; top: 6px; left: 0;">
                        <a href="{{mail_link($contact->email)}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">{{$contact->email}}</a>
                    </div>

                    <div style="margin-top: 30px;">

                        @foreach(social_contacts($contact) as $key => $social)
                            <a href="{{$social['href']}}"
                               style="position: relative; display: inline-block; vertical-align: middle; {{ $loop->last ? '' : 'margin-right: 10px;' }}">
                                <img loading="lazy" src="{{url(asset('icon/' . $social['icon']))}}" alt="skype"
                                     style="display: block; max-width: 22px; max-height: 22px;">
                            </a>
                        @endforeach

                    </div>
                </div>
            </td>

            <td style="vertical-align: top;">
                <div>
                    <div
                        style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 16px; line-height: 20px; margin-bottom: 10px;">
                        {{__('footer-section.address')}}
                    </div>
                    <div style="position: relative; padding-left: 30px; margin-bottom: 12px;">
                        <img loading="lazy" data-img-src="{{url(asset('icon/placeholder.png'))}}" alt="placeholder"
                             style="max-width: 18px; position: absolute; top: 2px; left: 0;">
                        <span
                            style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">{{$contact->address}}</span>
                    </div>

                    <div style="position: relative; padding-left: 30px; margin-bottom: 12px;">
                        <img loading="lazy" data-img-src="{{url(asset('icon/location.png'))}}" alt="location"
                             style="max-width: 18px; position: absolute; top: 3px; left: 0;">
                        <a href="geo:{{$contact->lat}},{{$contact->lng}}"
                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; text-decoration: none; color: #626262;">
                            GPS:{{$contact->lat}} , {{$contact->lng}}</a>
                    </div>
                    <a style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 12px; line-height: 24px; text-decoration: none; color: #323232; text-transform: uppercase;" href="{{$showOnMapUrl}}" target="_blank">
                        {{__('footer-section.show-on-map')}}
                        <i style="position: relative; display: inline-block; vertical-align: middle; width: 5px; height: 5px; border-top: 2px solid #323232; border-right: 2px solid #323232; transform: rotate(45deg); margin-top: -2px; margin-left: 4px;"></i></a>
                    <div
                        style="font-family: 'Roboto', sans-serif; font-weight: 500; font-size: 16px; line-height: 20px; margin-bottom: 10px; margin-top: 30px;">
                        {{__('footer-section.be-with-us')}}
                    </div>
                    <div style="margin-top: 30px;">

                        @foreach(config('contacts.social-links') as $key => $social)
                            <a href="{{$social['href']}}"
                               style="position: relative; display: inline-block; vertical-align: middle; {{ $loop->last ? '' : 'margin-right: 10px;' }}">
                                <img loading="lazy" src="{{url(asset('icon/' . $social['icon']))}}" alt="skype"
                                     style="display: block; max-width: 22px; max-height: 22px;">
                            </a>
                        @endforeach

                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

