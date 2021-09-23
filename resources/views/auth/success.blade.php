@extends('layout.app')

@section('content')
    <main class="registration-page">
        <div class="spacer-lg"></div>
        <div class="container">
            <div class="vertical-align">
                <div>
                    <div class="img done">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/done.svg')}}" alt="done">
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <h1 class="h1"><b>Реєстрацію завершено!</b></h1>
                        <span class="text-md">
                            Деталі реєстрації надіслані на вашу електронну адресу {{current_user()->email}}
                        </span>
                        <div class="spacer-xs"></div>
                        <a href="#" class="btn type-1">Увійти в кабінет</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-lg"></div>
    </main>
@endsection
