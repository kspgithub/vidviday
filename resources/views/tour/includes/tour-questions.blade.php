<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/faq.svg')}}"
                                            alt="faq"></span>Питання та відповіді<i></i>
    </div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            <div class="accordion-item">
                <div class="accordion-title">Загальні питання<i></i></div>
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
                <div class="accordion-title">Питання щодо туру<i></i></div>
                <div class="accordion-inner">
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

            <div class="accordion-item">
                <div class="accordion-title">Задати питання<i></i></div>
                <div class="accordion-inner">
                    <form action="{{route('tour.question', $tour->id)}}" class="row" method="POST"
                          v-is="'tour-question-form'">
                        <div class="col-md-6 col-12">
                            <label>
                                <i>Прізвище*</i>
                                <input type="text" name="last_name" required>
                            </label>
                        </div>

                        <div class="col-md-6 col-12">
                            <label>
                                <i>Ім’я*</i>
                                <input type="text" name="first_name" required>
                            </label>
                        </div>

                        <div class="col-md-6 col-12">
                            <label>
                                <i>Email*</i>
                                <input type="email" name="email" required>
                            </label>
                        </div>

                        <div class="col-md-6 col-12">
                            <label>
                                <i>Телефон</i>
                                <input type="tel" name="phone">
                            </label>
                        </div>

                        <div class="col-12">
                            <label>
                                <i>Ваш коментар*</i>
                                <textarea name="text" required></textarea>
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
            <x-tour.question :question="$question"/>
        @endforeach
    </div>
</div>

