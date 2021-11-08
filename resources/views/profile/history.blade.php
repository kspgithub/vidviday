@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.menu')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">

                    <!-- TAB #3 -->
                    <div class="tab active" id="search-history">
                        <div class="only-desktop-pad">
                            <h2 class="h2">Історія переглядів</h2>
                            <div class="text">Ми зберігаємо останні 36 турів переглянуті вами</div>
                            <hr>
                        </div>
                        <div v-is="'profile-history'"></div>
                    </div>
                    <!-- TAB #3 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection

