@if(count($tour->groupTourTickets))
    @if(true || in_array('ticket', $tour->active_tabs))
        <div class="accordion-item">
            <div class="accordion-title"><span><img loading="lazy" src="{{asset('/img/preloader.png')}}"
                                                    data-src="{{asset('/icon/tickets.svg')}}"
                                                    alt="tickets"></span>@lang('tours-section.entrance-tickets')<i></i>
            </div>
            <div class="accordion-inner">
                @if($sync = true)
                    @foreach($tour->groupTourTickets as $ticket)
                        <div class="tickets text text-md">
                            <p><b>{{$ticket->title}}:</b> {!! strip_tags($ticket->text) !!}</p>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    @endif
@endif
