@php
    $contacts = App\Models\Contact::get();
@endphp

{{--<div style="padding: 30px 8%;  background: #fff;  box-shadow: 0 2px 30px rgba(0, 0, 0, .06);">--}}
{{--    <table style="border-collapse: collapse; border: 0 none; margin: 0; width: 100%">--}}
{{--        <tr>--}}
{{--            <td style="width: 50%; vertical-align: middle; padding: 0;">--}}
{{--                <a href="{{url('/')}}">--}}
{{--                    <img src="{{url(asset('img/logo.png'))}}" alt="logo" style="display: block; width: 100%; max-width: 150px">--}}
{{--                </a>--}}
{{--            </td>--}}
{{--            <td style="width: 50%; vertical-align: middle; text-align: right; padding: 0; line-height: 1;">--}}
{{--                <span style="position: relative; padding-left: 55px; min-height: 40px; display: inline-block;">--}}
{{--                    <i--}}
{{--                        style="left: 0; top: 0; width: 40px; height: 40px; position: absolute; border-radius: 50%; text-align: center; border: 1px solid #E9E9E9; ">--}}
{{--                        <img src="{{url(asset('icon/smartphone.png'))}}" alt="smartphone"--}}
{{--                             style="display: inline-block; margin-top: 10px;">--}}
{{--                    </i>--}}
{{--                    @foreach($contacts as $phone)--}}
{{--                        <a href="tel:{{$phone->work_phone}}"--}}
{{--                           style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">--}}
{{--                            {{$phone->work_phone}}</a>--}}
{{--                        <br>--}}
{{--                        <a href="tel:{{$phone->phone_1}}"--}}
{{--                               style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">--}}
{{--                                {{$phone->phone_1}}</a>--}}
{{--                            <br>--}}
{{--                        <a href="tel:{{$phone->phone_2}}"--}}
{{--                               style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">--}}
{{--                                {{$phone->phone_2}}</a>--}}
{{--                            <br>--}}
{{--                        <a href="tel:{{$phone->phone_3}}"--}}
{{--                               style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">--}}
{{--                                {{$phone->phone_3}}</a>--}}
{{--                            <br>--}}
{{--                    @endforeach--}}
{{--                    <a href="tel:+380322553655"--}}
{{--                       style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">+38 (032) 255 36 55</a>--}}
{{--                    <br>--}}
{{--                    <a href="tel:+380964813670"--}}
{{--                       style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">+38 (096) 481 36 70</a>--}}
{{--                </span>--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</div>--}}



<div class="header">
    <a href="{{url('/')}}" class="logo">
        <img src="{{url(asset('img/logo.png'))}}" alt="logo" style="display: block; width: 100%; max-width: 150px">
    </a>

    <div style="display: inline-block; position: relative; padding-left: 55px;">
        <div class="tel-icon">
            <img src="{{ url(asset('icon/smartphone.png')) }}" alt="smartphone" style="display: inline-block">
        </div>

        @foreach($contacts as $phone)
            <a href="tel:{{$phone->work_phone}}" style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                {{$phone->work_phone}}</a>
            <br>
            <a href="tel:{{$phone->phone_1}}" style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                {{$phone->phone_1}}</a>
            <br>
            <a href="tel:{{$phone->phone_2}}" style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                {{$phone->phone_2}}</a>
            <br>
            <a href="tel:{{$phone->phone_3}}" style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                {{$phone->phone_3}}</a>
            <br>
        @endforeach
    </div>
</div>
