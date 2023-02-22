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
                        <h2 class="h2">Видалення аккаунту</h2>
                        <hr>
                        <div>
                            <p>Ви впевнені що хочете видалити свій аккаунт?</p>
                            <p class="mb-30">Цю дію не можна буде відмінити.</p>

                            <form action="{{route('profile.delete.confirm')}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <x-seo-button key="auth.delete_account" type="submit" class="btn btn-danger">Так, видалити аккаунт</x-seo-button>
                            </form>
                        </div>
                    </div>
                    <!-- TAB #4 END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection

