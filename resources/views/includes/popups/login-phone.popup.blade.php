<!-- LOGIN POPUP 2 -->
<div class="popup-content" data-rel="login-popup-2">
    <div class="layer-close"></div>
    <div class="popup-container size-2">
        <div class="popup-align">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">Вхід в кабінет</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form action="/">
                        <label data-tooltip="Поле обов’язкове до заповнення">
                            <i>Номер телефону*</i>
                            <input type="text" name="tel" required>
                        </label>
                        <x-seo-button :code="'auth.login'" href="#" class="btn type-1 btn-block">Увійти</x-seo-button>
                    </form>
                    <div class="spacer-xs"></div>
                    <div class="text text-sm">{{__('forms.required-fields')}}</div>
                </div>
            </div>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
        <div class="popup-footer">
            <span class="text">Немає аккаунту? <a href="{{route('auth.register')}}">Реєстрація</a></span>
        </div>
    </div>
</div>
<!-- LOGIN POPUP 2 END -->

