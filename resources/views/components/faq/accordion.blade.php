
<div class="accordion-all-expand">
    <div class="expand-all-button">
        <div class="expand-all open">Розгорнути все</div>
        <div class="expand-all close">Згорнути все</div>
    </div>
    <div class="accordion type-5">
        @foreach ($items as $item)
            <div class="accordion-item {!! ($loop->iteration == 1 || $expand === 'all') && $expand !== 'none' ? 'active' : '' !!}">
                <div class="accordion-title">
                    <b>{{ $loop->iteration > 9 ? $loop->iteration : "0".$loop->iteration }}.</b>
                    {{ $item->question }}<i></i>
                </div>
                <div class="accordion-inner"
                    {!! ($loop->iteration == 1 || $expand === 'all') && $expand !== 'none' ? 'style="display: block;"' : '' !!}>
                    <div class="text text-md">
                        <p> {!! $item->answer !!} </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="expand-all-button">
        <div class="expand-all open">Розгорнути все</div>
        <div class="expand-all close">Згорнути все</div>
    </div>
</div>
