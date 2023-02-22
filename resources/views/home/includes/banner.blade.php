@if($banners->count() > 0)
    <section class="section">
        <div class="tab-top-part active" data-tab="1">
            <div class="banner-carousel">
                <div class="swiper-entry">
                    <div class="banner-carousel-controls">
                        <div class="swiper-button-prev">
                            <i></i>
                        </div>
                        <div class="swiper-pagination light"></div>
                        <div class="swiper-button-next">
                            <i></i>
                        </div>
                    </div>
                    <div class="swiper-container" data-options='{
										"loop": {{ count($banners) > 1 ? 'true' : 'false' }},
										"autoHeight": true,
										"parallax": true,
										"speed": 900,
										"lazy": true,
										"autoplay": {
											"delay": 5000
										},
										"breakpoints": {
											"1200": {
												"autoplay": {
													"delay": 5000
												}
											},
											"0": {
												"autoplay": false
											}
										}
									}'>
                        <div class="swiper-wrapper">
                            @foreach($banners as $banner)
                                <div class="swiper-slide">
                                    <img src="{{asset('img/preloader.png')}}"
                                         data-src="{{$banner->image_url}}"
                                         title="{{$banner->image_title ?? $banner->title}}"
                                         alt="{{$banner->image_alt ?? $banner->title}}"
                                         data-swiper-parallax="30%"
                                         class="swiper-lazy">
                                    <div class="swiper-lazy-preloader"></div>
                                    @if(!empty($banner->label))
                                        <span class="label"
                                              style="background-color: {{$banner->color}}">{{$banner->label}}</span>
                                    @endif
                                    <div class="full-size">
                                        <div>
                                            <h2 class="h1 title light">
                                                <a href="{{$banner->url}}">{{$banner->title}}</a>
                                            </h2>
                                            <div class="spacer-xs"></div>
                                            <div class="text-md light">
                                                <span>{{str_limit($banner->text, 300)}}</span>
                                                <x-seo-button key="common.more_banners" href="{{$banner->url}}"
                                                              class="btn type-3 btn-more light">@lang('More')</x-seo-button>
                                            </div>
                                        </div>

                                        <div>
                                            @if($banner->show_price)
                                                <span class="h1">{{currency_value($banner->price, $banner->currency)}}
                                                <span
                                                    class="text light">/ {{current_currency($banner->currency)}}</span>
                                            </span>
                                                <span class="text-sm light">{{$banner->price_comment}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-xs"></div>
        </div>
    </section>

@endif
