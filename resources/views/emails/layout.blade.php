<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{url(asset('img/favicon.ico'))}}">
    <title>Відвідай</title>
    <style>
        .header {
            text-align: right;
            padding: 30px 8%;
            position: relative;
            background-color: #fff;
            box-shadow: 0 2px 30px rgba(0, 0, 0, .06);
        }

        .logo {
            top: 50%;
            left: 8%;
            max-width: 146px;
            position: absolute;
            transform: translateY(-50%);
        }

        .tel-icon {
            left: 0;
            top: 50%;
            width: 40px;
            height: 40px;
            line-height: 50px;
            position: absolute;
            border-radius: 50%;
            text-align: center;
            box-sizing: border-box;
            border: 1px solid #E9E9E9;
            transform: translateY(-50%);
        }

        .body {
            padding: 40px 8%;
        }

        .title {
            color: #323232;
            font-size: 26px;
            line-height: 46px;
            font-weight: bold;
            font-family: 'Roboto', sans-serif;
        }

        table {
            width: 100%;
            margin: 30px 0;
            padding: 6px 20px;
            position: relative;
            border-radius: 5px;
            background-color: #ffffff;
        }

        td {
            font-size: 16px;
            line-height: 36px;
        }

        .footer {
            padding: 40px 8%;
            background-color: #FAFAFA;
            border-top: 1px solid #E9E9E9;
        }

        .footer td {
            width: 50%;
        }

        @media (max-width: 767px) {

            .header {
                padding: 15px;
            }

            .logo {
                left: 15px;
                max-width: 110px;
            }

            .tel-icon {
                display: none;
            }

            .tel-icon + a {
                /*margin-bottom: 5px;*/
                display: inline-block;
            }

            .body {
                padding: 30px 15px;
            }

            .title {
                font-size: 18px;
                line-height: 28px;
            }

            table {
                padding: 15px 0;
            }

            td {
                /*width: 100%;
                display: block;*/
                padding: 10px 0;
                font-size: 14px;
                line-height: 24px;
                vertical-align: top;
            }

            .body td:last-child {
                text-align: right;
                padding-left: 10px;
            }

            .footer {
                padding: 15px;
            }

            .footer table {
                margin: 0;
                padding: 0;
            }

            .footer td {
                width: 100%;
                display: block;
                margin-bottom: 30px;
            }

            .footer td:last-child {
                margin-bottom: 0;
            }

            .footer td div > img {
                margin-top: -4px;
            }
        }
    </style>
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

@env('local')
    <script>
        let styles = ''

        for(let style of document.getElementsByTagName('style')) {
            styles += style.innerText.replaceAll(/[\n\t\r]+/g, '')
            style.remove()
        }

        let cb = document.createElement('input')

        let style

        function toggleStyles(e) {
            style?.remove()
            if(e.target.checked) {
                style = document.createElement('style')
                style.innerText = styles
                document.body.appendChild(style)
            }
        }

        Object.assign(cb, {
            type: 'checkbox',
            checked: false,
            onchange: toggleStyles
        })

        let cbWrapper = document.createElement('label')

        Object.assign(cbWrapper, {
            innerText: 'Toggle styles',
            style: 'position: fixed;top: 0;right:0;'
        })

        cbWrapper.append(cb)

        document.body.append(cbWrapper)
    </script>
@endenv
</body>
</html>
