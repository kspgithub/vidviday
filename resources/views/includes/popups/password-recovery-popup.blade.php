<!-- PASSWORD RECOVERY POPUP -->
<div class="popup-content" data-rel="password-recovery-popup">
    <div class="layer-close"></div>
    <div class="popup-container size-2">
        <div class="popup-align">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">{{__('auth.password-recovery')}}</span>
                        <br>
                        <span class="text">{{__('auth.password-recovery-message')}}</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form action="{{ route('auth.password.email') }}" method="post">
                        @csrf
                        <label data-tooltip="{{__('auth.required')}}">
                            <i>Email*</i>
                            <input type="text" name="email" required>
                        </label>
                        <button v-bind="$buttons.auth.recover" type="submit" class="btn type-1 btn-block">{{__('auth.recover-password')}}</button>
                    </form>
                    <div class="spacer-xs"></div>
                    <div class="text text-sm">{{__('auth.required-fields')}}</div>
                </div>
            </div>
            <div class="btn-close">
                <span></span>
            </div>
        </div>
        <div class="popup-footer">
            <span class="text">
                {{__('auth.back-to')}}
                <span class="open-popup open-popup-link" data-rel="login-popup">{{__('auth.to-entrance')}} </span>
            </span>
        </div>
    </div>
</div>
<!-- PASSWORD RECOVERY POPUP END -->
