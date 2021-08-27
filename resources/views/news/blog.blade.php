@extends("layout.app")

@section("title") {{ __("Відвідай | Новини") }} @endsection


@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{ route("home") }}">{{ __("Головна") }}</a>
                <span>—</span>
                <span>{{ __("Новини") }}</span>
            </div>
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
                                    <img src="img/preloader.png" data-img-src="img/img_25.jpg" alt="img 25">
                                    <a href="{{ route("post", ["slug" => $post->slug]) }}" class="full-size"></a>
                                </div>
                                <div class="thumb-content">
                                    <div class="title h3">
                                        <a href="{{ route("post", ["slug" => $post->slug]) }}">{{ $post->title }}</a>
                                    </div>
                                    <span class="text text-sm">{{ $post->created_at->format("d.m.Y") }}</span>
                                    <div class="text">
                                        <p>{!! $post->text !!}</p>
                                        <a href="{{ route("post", ["slug" => $post->slug]) }}" class="btn btn-read-more text-bold">{{ __("Читати більше") }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="spacer-xs"></div>

                    <div class="pagination">
                        <a href="post.php" class="btn btn-read-more left-arrow text-bold">Назад</a>
                        <div>
                            <a href="blog.php" class="text">1</a>
                            <span class="text">...</span>
                            <a href="blog.php" class="text">7</a>
                            <a href="blog.php" class="text active">8</a>
                            <a href="blog.php" class="text">9</a>
                            <span class="text">...</span>
                            <a href="blog.php" class="text">12</a>
                        </div>
                        <a href="post.php" class="btn btn-read-more text-bold">Вперед</a>
                    </div>

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
