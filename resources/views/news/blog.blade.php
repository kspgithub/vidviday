@extends("layout.app")

@section("title") {{ __("Відвідай | Новини") }} @endsection


@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->

              @include("news.includes.bread_crumbs")

            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                       @include('includes.sidebar')
                    <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12 news">

                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img src="img/preloader.png" data-img-src="icon/filter-dark.svg" alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>

                    <h1 class="h1">{{ __("Новини") }}</h1>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tempore nesciunt deleniti. Nisi explicabo provident ipsum sapiente, temporibus sed error!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae repellendus nam eum quia explicabo perspiciatis!</p>
                    </div>

                    <div class="spacer-xs"></div>

                    <div>

                        @foreach($blog as $post)
                            <div class="item post">
                                <div class="thumb-img">
                                    <img src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset('storage/media/news/'.$post->media->get(0)->id.'/'.$post->media->get(0)->file_name) }}" alt="img 25">
                                    <a href="{{ route("post", ["slug" => $post->slug]) }}" class="full-size"></a>
                                </div>
                                <div class="thumb-content">
                                    <div class="title h3">
                                        <a href="{{ route("post", ["slug" => $post->slug]) }}">{{ $post->title }}</a>
                                    </div>
                                    <span class="text text-sm">{{ $post->created_at->format("d.m.Y") }}</span>
                                    <div class="text">
                                        <p>{{ $post->short_text }}</p>
                                        <a href="{{ route("post", ["slug" => $post->slug]) }}" class="btn btn-read-more text-bold">{{ __("Читати більше") }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="spacer-xs"></div>

                    {{ $blog->links('paginate.vendor.pagination.newsCustom') }}

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
