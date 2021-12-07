@extends('layout.app')


@section('content')
    <main>
        <div class="container">


            <div class="row">


                <div class="col-12">
                    <x-tour.mobile-search-btn/>

                    <div class="section text-center">
                        <div class="spacer-xs"></div>
                        <span class="error">503</span>
                        <h1 class="h1 title">Ведуться технічні роботи</h1>
                        <div class="text text-md">
                            <p>Скоро ми знову запрацюємо</p>
                        </div>

                        <div class="spacer-lg"></div>
                        <hr>
                        <div class="spacer-xs"></div>
                    </div>


                </div>
            </div>
        </div>
    </main>

@endsection
