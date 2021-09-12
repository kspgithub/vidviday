@extends("layout.app")

@section("title") {{ __("Vidviday | Blog") }} @endsection


@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->

                @include("blog.includes.bread_crumbs")

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
                    <h1 class="h1">{{ __("Blogs") }}</h1>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tempore nesciunt deleniti. Nisi explicabo provident ipsum sapiente, temporibus sed error!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae repellendus nam eum quia explicabo perspiciatis!</p>
                    </div>
                    <div class="spacer-xs"></div>
                    <div>

                        @foreach($blogs as $blog)


                            <div class="item post">
                                <div class="thumb-img">
                                    @foreach($blog->media as $media)

                                        @if($media->collection_name === "main")
                                            <img src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset('storage/media/blog/'.$media->id.'/'.$media->file_name) }}" alt="img 25">
                                            <a href="{{ route("post", ["slug" => $blog->slug]) }}" class="full-size"></a>
                                        @endif

                                    @endforeach
                                </div>
                                <div class="thumb-content">
                                    <div class="title h3">
                                        <a href="{{ route("post", ["slug" => $blog->slug]) }}">{{ $blog->title }}</a>
                                    </div>
                                    <span class="text text-sm">{{ $blog->created_at->format("d.m.Y") }}</span>
                                    <div class="text">
                                        <p>{{ $blog->short_text }}</p>
                                        <a href="{{ route("post", ["slug" => $blog->slug]) }}" class="btn btn-read-more text-bold">{{ __("Читати більше") }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="spacer-xs"></div>

                    {{ $blogs->links('paginate.vendor.pagination.blogCustom') }}

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
