<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <title>Відвідай</title>

</head>
<body>
<div style="max-width: 720px; margin: 0 auto; background-color: #FAFAFA;">
    <!-- HEADER -->
@include('emails.includes.header')
<!-- END HEADER  -->

    <div style="font-family: 'Roboto', sans-serif;
        font-size: 16px;
        line-height: 28px;
        color: #626262;  padding: 40px 8%;">
        @yield('content')
    </div>


    <!-- FOOTER -->
@if(isset($showFooter) && $showFooter === true)
    @include('emails.includes.footer')
@endif
<!-- FOOTER END -->
</div>
</body>
</html>
