@extends('layout.app')


@section('content')
    <main>
        <div class="container">

            <div class="row">

                <div class="col-12">
                    <x-tour.mobile-search-btn/>

                    <div class="section text-center">
                        <div class="spacer-xs"></div>
                        <span class="error">500</span>
                        <h1 class="h1 title">Нажаль, виникла помилка</h1>
                        <div class="text text-md">
                            <p>Пропонуємо повернутися на головну сторінку</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <a href="/" class="btn type-1">На головну</a>
                        <div class="spacer-lg"></div>
                        <hr>
                        <div class="spacer-xs"></div>
                    </div>


                </div>
            </div>
        </div>
    </main>

@endsection
