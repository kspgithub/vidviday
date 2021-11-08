@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.menu')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #4 -->
                    <div class="tab active" id="favorites">
                        <h2 class="h2">Улюблені</h2>
                        <hr>
                        <div v-is="'profile-favourites'"></div>
                    </div>
                    <!-- TAB #4 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection

