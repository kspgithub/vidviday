<!-- MANAGER TESTIMONIAL POPUP -->
<div class="popup-content" data-rel="manager-testimonial-popup">
    <div class="layer-close"></div>
    <div class="popup-container size-1">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">Залишити відгук про менеджера</span>
            </div>
        </div>
        <div class="popup-align">
            <div class="have-an-account text-center">
                <span class="text">{{__('auth.have-account')}} <span class="open-popup"
                                                                     data-rel="login-popup">{{__('auth.entrance')}}</span></span>

                <div class="img-input-wrap">
                    <div class="img-input">
                        <input type="file">
                        <div class="text">
                            <span><b>{{__('forms.avatar-title')}}</b> {{ __('forms.avatar-note') }}</span>
                            <br>
                            <span>{{ __('forms.avatar-requirements') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/" class="row">
                <div class="col-md-6 col-12">
                    <label data-tooltip="{{__('forms.required')}}">
                        <i>{{__('forms.your-name')}}*</i>
                        <input type="text" name="name" required>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>{{__('forms.your-last-name')}}</i>
                        <input type="text" name="surname">
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>{{__('forms.your-phone')}}</i>
                        <input type="tel" name="tel">
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <label>
                        <i>{{__('forms.email')}}</i>
                        <input type="text" name="email">
                    </label>
                </div>

                <div class="col-12">
					<span class="text text-sm">
						<b>Тур у якому ви були</b>
					</span>
                    <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                        <option value="guid-0" selected disabled>Введіть назву чи оберіть зі списку</option>
                        <option value="guid-1" data-img="{{ asset('img/user.jpg') }}">Тур 1</option>
                        <option value="guid-2" data-img="{{ asset('img/user.jpg') }}">Тур 2</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="smile" data-tooltip="{{__('forms.required')}}">
                        <i>Ваш відгук*</i>
                        <textarea required></textarea>
                    </label>
                </div>

                <div class="col-md-6 col-12">
                    <div class="img-input-wrap text-center-xs">
                        <div class="img-input tooltip-wrap">
                            <div class="tooltip">
                                <span class="text-medium">{{ __('forms.add-tour-photo') }}</span>
                                <div class="text text-sm">
                                    <ul>
                                        <li>{{ __('forms.max-image-size-3') }}</li>
                                        <li>{{ __('forms.max-image-count-5') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <input type="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 text-right text-center-xs">
                    <span class="btn type-1 open-popup" data-rel="thanks-popup">{{ __('forms.leave-feedback') }}</span>
                </div>

                <div class="text-center-xs col-12">
                    <div class="only-mobile spacer-sm"></div>
                    <span class="text-sm">{{__('forms.required-fields')}}</span>
                </div>
            </form>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
    </div>
</div>
<!-- MANAGER TESTIMONIAL POPUP END -->

