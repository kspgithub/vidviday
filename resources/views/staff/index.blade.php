@extends('layout.app')
@section('content')
	<main>
		<div class="container">
			<!-- BREAD CRUMBS -->
			<div class="bread-crumbs">
				<a href="{{url('/')}}">Головна</a>
				<span>—</span>
				<span>Офісні працівники</span>
			</div>
			<!-- BREAD CRUMBS END -->
			<div class="row">
				<div class="order-xl-1 order-2 col-xl-3 col-12">
					<!-- SIDEBAR -->
						@include('includes.sidebar')
					<!-- SIDEBAR END -->
				</div>

				<div class="order-xl-2 order-1 col-xl-9 col-12">
					<!-- BANNER/INFO -->
					<div class="section">
						<!-- BANNER TABS -->
                        @include('staff.includes.banner')
						<!-- BANNER TABS END -->
						<div class="spacer-xs"></div>
						<h1 class="h1 title">Офісні працівники</h1>
						<div class="text text-md">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tempore nesciunt deleniti. Nisi explicabo provident ipsum sapiente, temporibus sed error!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae repellendus nam eum quia explicabo perspiciatis!</p>
						</div>
						<div class="spacer-xs"></div>
					</div>
					<!-- BANNER/INFO END -->

					<div class="section">
						<div class="thumb-wrap row">
                            @foreach ($staff as $staff)
							<div class="col-lg-4 col-md-6 col-12">
								<div class="img img-border img-caption style-2">
									<div class="top-part text-center">
										<span class="h3 light text-bold">{!! $staff->types->implode('title', '<br>') !!}</span>
									</div>
									<div class="zoom centered">
										<img src="img/preloader.png" data-img-src="{{ $staff->avatar ?? asset('img/no-image.png') }}" alt="{{$staff->first_name}} {{$staff->last_name}}">
                                        <a href="{{ route('office-worker', ['id'=>$staff->id])}}" class="full-size"></a>
									</div>
									<div class="img-caption-info">
										<div class="guide-name">
											<span class="h3">
												<a href="{{ route('office-worker', ['id'=>$staff->id])}}">{{$staff->first_name}} {{$staff->last_name}}</a>
											</span>
											<span class="text">{{$staff->position}}</span>
										</div>
										<hr>
										<div class="contact">
											<a href="tel:{{$staff->phone}}">{{$staff->phone}}</a>
											<br>
										</div>

										<div class="contact">
											<a href="mailto:{{$staff->email}}">{{$staff->email}}</a>
										</div>

										<div class="contact">
											<div class="img">
												<img src="img/preloader.png" data-img-src="{{asset('icon/skype.svg')}}" alt="skype">
											</div>
											<a href="skype:{{$staff->skype}}?call">{{$staff->skype}}</a>
										</div>

										<div class="contact">
											<div class="img">
												<img src="img/preloader.png" data-img-src="{{asset('icon/viber.svg')}}" alt="viber">
											</div>
											<a href="viber:{{$staff->viber}}">{{$staff->viber}}</a>
										</div>

										<div class="contact">
											<div class="img">
												<img src="img/preloader.png" data-img-src="{{asset('icon/whatsapp.svg')}}" alt="whatsapp">
											</div>
											<a href="whatsapp:{{$staff->whatsapp}}">{{$staff->whatsapp}}</a>
										</div>

										<div class="contact">
											<div class="img">
												<img src="img/preloader.png" data-img-src="{{asset('icon/telegram.svg')}}" alt="telegram">
											</div>
											<a href="telegram:{{$staff->telegram}}">{{$staff->telegram}}</a>
										</div>
										<div class="spacer-xs"></div>
										<a href="{{ route('office-worker', ['id'=>$staff->id])}}" class="btn type-1 btn-block">Дізнатись більше</a>

									</div>
								</div>
							</div>
                            @endforeach
						</div>
					</div>
                    <!-- MOBILE BUTTONS BAR -->
                    <div class="only-pad-mobile">
                        <div class="row short-distance">
                            <div class="col-md-4 col-12 only-pad">
                                <span class="btn type-4 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</span>
                            </div>

                            <div class="col-md-4 col-12 only-pad">
                                <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/tours-scedule-dark.svg')}}" alt="tours scedule dark">Завантажити розклади турів</a>
                            </div>

                            <div class="col-md-4 col-12">
                                <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}" alt="filter-dark">Підбір туру</span>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- MOBILE BUTTONS BAR END -->
				</div>
			</div>
			<div class="spacer-lg"></div>
		</div>

		<!-- SEO TEXT -->
        @include('staff.includes.seo-text')
		<!-- SEO TEXT END -->
	</main>

@endsection
