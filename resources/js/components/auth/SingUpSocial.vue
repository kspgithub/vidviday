<template>
    <div class="tab-top-part active" data-tab="1">
        <div class="or">
            <span class="text">{{ __('auth.or') }}</span>
        </div>
        <div class="spacer-sm"></div>
        <div class="row form">
            <div class="col-md-6 col-12">
                <a href="/auth/login/facebook" class="btn type-1 btn-block btn-fb">
                    <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z"/>
                    </svg>
                    {{__('auth.sign-in-with')}} Facebook</a>
                <div class="only-mobile spacer-xs"></div>
            </div>

            <div class="col-md-6 col-12">
                <a href="/auth/login/google" class="btn type-1 btn-block btn-google">
                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 6.4v3.2h4.526A4.81 4.81 0 018 12.8 4.806 4.806 0 013.2 8c0-2.646 2.154-4.8 4.8-4.8 1.147 0 2.251.411 3.109 1.158l2.102-2.412A7.928 7.928 0 008 0C3.589 0 0 3.589 0 8s3.589 8 8 8 8-3.589 8-8V6.4H8z"/>
                    </svg>
                    {{__('auth.sign-in-with')}} Google</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingUpSocial",
}
</script>

<style scoped>

</style>
