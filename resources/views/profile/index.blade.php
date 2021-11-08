@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.menu')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #1 -->
                    <form v-is="'profile-info-form'" action='{{route('profile.update')}}'
                          :user='@json(current_user())'
                    >
                        @csrf
                        @method('PATCH')
                    </form>
                @if(is_tourist())

                @endif
                <!-- TAB #1 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
