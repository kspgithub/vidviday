<div class="accordion-item active">
    <div class="accordion-title">
    <span><img src="{{asset('/img/preloader.png')}}"
               data-img-src="{{asset('/icon/plan.svg')}}"
               alt="plan"></span>План туру<i></i></div>
    <div class="accordion-inner" style="display: block;">
        <div class="text text-md">
            @foreach($tour->planItems as $planItem)
                <h4>{{$planItem->title}}</h4>
                <p>{{$planItem->text}}</p>
            @endforeach
        </div>
    </div>

</div>
