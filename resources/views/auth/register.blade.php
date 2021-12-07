@extends('layout.app')

@section('content')
    <main class="registration-page">
        <div class="spacer-lg"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                    <form action="{{route('auth.register.store')}}" v-is="'sign-up-form'">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="spacer-lg"></div>
    </main>

@endsection
