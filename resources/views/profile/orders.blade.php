@php use App\Models\QuestionType; @endphp
@extends('layout.app')

@section('content')

    <main class="tabs cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('profile.includes.menu')
                </div>

                <div class="col-xl-9 col-12 tabs-wrap">
                    <!-- TAB #2 -->
                    <div class="tab active" id="history">
                        <div class="only-desktop-pad">
                            <h2 class="h2">Історія замовлень</h2>
                            <hr>
                        </div>
                        <div class="accordion type-1">
                            @foreach($orders as $order)
                                @include('profile.includes.order', ['order'=>$order])
                            @endforeach

                            @if($orders->count() == 0)
                                <div class="py-30">У вас ще немає замовлень</div>
                            @endif
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- TAB #2 END -->

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection


@push('after-popups')
    <div v-is="'testimonial-popup-form'"
         :user='@json(current_user())'
         action='{{route('testimonials.store')}}'
         :data-parent="0"
    >
        @csrf
    </div>
    <div v-is="'order-cancel-popup'"
             :question-types='@json(App\Models\QuestionType::where('type', App\Models\UserQuestion::TYPE_CANCEL)->get()->values()->map->asSelectBox())'
    ></div>
@endpush
