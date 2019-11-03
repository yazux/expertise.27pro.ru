<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1280, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link onload="if(media!='all') media='all'" rel="stylesheet" href="{{ Asset('/css/app.css') }}">
        <link rel="canonical" href="{{ url(Request::url()) }}" />

        <link rel="apple-touch-icon" sizes="57x57" href="/public/img/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/public/img/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/public/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/public/img/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/public/img/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/public/img/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/public/img/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/public/img/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/public/img/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/public/img/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/public/img/favicon-194x194.png" sizes="194x194">
        <link rel="icon" type="image/png" href="/public/img/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/public/img/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/public/img/favicon-16x16.png" sizes="16x16">
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149937449-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-149937449-1');
        </script>
                
        <title>{{ setting('site.title') }}</title>
        <meta name="description" content="{{setting('site.description')}}">

        <style lang="css">
            :root {
                --color-one: #3e444c;
                --color-two: #de6d59;
                --color-third: #cbcbcb;
                --text-color-white: #ededed;
                --text-color-black: #000000;
            }
        </style>
    </head>
    <body id="body">
        <div id="app">
            @yield('content')
        </div>
    </body>
    <script async src="{{ Asset('/js/app.js') }}"></script>
</html>
