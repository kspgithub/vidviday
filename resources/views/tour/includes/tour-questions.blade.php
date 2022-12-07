@if(in_array('faq', $tour->active_tabs))
    <div class="accordion-item  hidden-print">
        <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                                data-img-src="{{asset('/icon/faq.svg')}}"
                                                alt="faq"></span>@lang('tours-section.q-and-a')<i></i>
        </div>
        <div class="accordion-inner">
            @if($sync = true)
                <div class="accordion type-2">
                    <div class="accordion-item">
                        <div class="accordion-title">@lang('tours-section.faq.section-common-questions')<i></i></div>
                        <div class="accordion-inner">
                            <div class="accordion type-3">
                                @foreach($faq_items as $faq_item)
                                    <div class="accordion-item">
                                        <div class="accordion-title">{{$faq_item->question}}<i></i></div>
                                        <div class="accordion-inner">
                                            <div class="text">
                                                <p>{{$faq_item->answer}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">@lang('tours-section.faq.section-tour-questions')<i></i></div>
                        <div class="accordion-inner">
                            <div class="accordion type-3">
                                @foreach($tour->faq as $faq_item)
                                    <div class="accordion-item">
                                        <div class="accordion-title">{{$faq_item->question}}<i></i></div>
                                        <div class="accordion-inner">
                                            <div class="text">
                                                <p>{{$faq_item->answer}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">@lang('tours-section.faq.section-ask-question')<i></i></div>
                        <div class="accordion-inner">
                            <form action="{{route('tour.question', $tour->id)}}" class="row" method="POST"
                                  v-is="'tour-question-form'">
                                <div class="col-md-6 col-12">
                                    <label>
                                        <i>Прізвище*</i>
                                        <input type="text" name="last_name"  rules="required">
                                    </label>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label>
                                        <i>Ім’я*</i>
                                        <input type="text" name="first_name"  rules="required">
                                    </label>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label>
                                        <i>Email*</i>
                                        <input type="email" name="email"  rules="required|email">
                                    </label>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label>
                                        <i>Телефон</i>
                                        <input type="tel" name="phone" mask="+38 (099) 999-99-99" rules="required|tel">
                                    </label>
                                </div>

                                <div class="col-12">
                                    <label>
                                        <i>Ваш коментар*</i>
                                        <textarea name="text" rules="required"></textarea>
                                    </label>
                                    <button type="submit"
                                            class="btn type-1 open-popup" data-rel="thanks-popup">Надіслати
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @foreach($tour->questions->toTree() as $question)
                    <x-tour.question :question="$question" :rating="false"/>
                @endforeach
            @endif
        </div>
    </div>

@endif
