@php
    $contacts = App\Models\Contact::get();
@endphp

<div class="header" style="padding: 30px 8%;  background: #fff;  box-shadow: 0 2px 30px rgba(0, 0, 0, .06);">
    <a href="{{url('/')}}" class="logo">
        <img src="{{url(asset('img/logo.png'))}}" alt="logo"style="display: block; width: 100%; max-width: 150px">
    </a>

    <div style="display: inline-block; position: relative; padding-left: 55px;">

        <span style="position: relative; padding-left: 55px; min-height: 40px; display: inline-block;">
            <div class="tel-icon">
                <img src="{{url(asset('icon/smartphone.png'))}}" alt="smartphone" style="display: inline-block">
            </div>

            @foreach($contacts as $phone)
                <a href="tel:{{$phone->work_phone}}"
                   style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                            {{$phone->work_phone}}</a>
                <br>
                <a href="tel:{{$phone->phone_1}}"
                   style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                                {{$phone->phone_1}}</a>
                <br>
                <a href="tel:{{$phone->phone_2}}"
                   style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                                {{$phone->phone_2}}</a>
                <br>
                <a href="tel:{{$phone->phone_3}}"
                   style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 20px; color: #626262; text-decoration: none;">
                                {{$phone->phone_3}}</a>
                <br>
            @endforeach
        </span>

    </div>
</div>
