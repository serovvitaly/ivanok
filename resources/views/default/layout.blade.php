<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name='yandex-verification' content='5de340fd1ce598f6' />

    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    <title>@yield('title')</title>

    <script src="/js/jquery.min.js"></script>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Molle:400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link href="/lib/lightslider/src/css/lightslider.css" rel="stylesheet">

    <script>
        var CSRF_TOKEN = '{{ csrf_token() }}';
        function getCsrfToken(){
            return CSRF_TOKEN;
        }
    </script>

    <style>
        .logo {
            font-size: 30px;
            font-family: 'Molle', cursive;
            color: #337ab7;
        }
        body {
            /*background: #FBFBFB fixed;*/
        }
        #main-container {
            background: white;
            /*-webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, .15);
                    box-shadow: 0px 0px 12px rgba(0, 0, 0, .15);*/
        }
        .lobster {
            font-family: 'Lobster', cursive;
        }
        .font-condensed {
            font-family: 'Open Sans Condensed',sans-serif;
        }
        .title {
            font-family: 'Open Sans Condensed',sans-serif;
            font-weight: bold;
        }
        .title a {
            color: #131313;
        }
        .strong {
            font-weight: bold;
        }
        .color-grey {
            color: grey;
        }
        h1.title {
            font-size: 30px;
        }
        h2.title {
            font-size: 28px;
        }
        .fa-btn {
            margin-right: 6px;
        }
        .content p {
            margin: 0 0 14px;
        }
        .liner {
            display: inline-block;
            padding-right: 16px;
        }
        .head2 {
            font-size: 20px;
            display: block;
            margin: 5px 0 5px;
            line-height: 20px;
        }
        .head3 {
            font-size: 18px;
            display: block;
            margin: 5px 0 5px;
            line-height: 20px;
        }
        .post-description {
            font-size: 18px;
            font-family: 'Open Sans Condensed',sans-serif;
            font-weight: bold;
        }
        .box {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-family: 'Open Sans Condensed',sans-serif;
            font-weight: bold;
            font-size: 20px;
            line-height: 20px;
            text-align: center;
        }
        .box-info {
            color: #E7F7FF;
            background-color: #3998C7;
            border-color: #1D7AA9;
        }
        .box-gallery {
            margin: 20px 0 20px;
        }
        .micro-post-item{
            margin-bottom: 20px;
            background-color: white;
            border-radius: 2px;
            border: 1px solid #d8d8d8;
            border-bottom-width: 2px;
        }
        .micro-post-wrapper{
            margin: 5px;
        }
        .micro-post-title{
            line-height: 10px;
            font-size: 14px;
            font-weight: bold;
            color: black;
        }
    </style>
</head>
<body>
<div id="main-container" class="container">
    <div class="row">
        <div class="collapse navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}" class="logo">Ivanok.ru</a></li>
                <li><a href="{{ url('/guru/') }}">Интересные статьи</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    {{--<li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>--}}
                @else
                    {{--<li>
                        <a href="/post">Мои посты</a>
                    </li>
                    <li>
                        <a href="/post/create" class="btn-danger">Создать пост</a>
                    </li> --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@yield('content')
</div>
<div class="container">
    <hr>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 text-center title">
            <strong>Laravel is a trademark of Taylor Otwell. Copyright © Taylor Otwell.</strong><br>
            Design by Jack McDade
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
{{-- @include('default.login-regist-modal') --}}
<!-- JavaScripts -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/js/jquery.sticky.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@if( ! \Auth::check() )
    @include('analytics')
@endif

<script src="/lib/lightslider/src/js/lightslider.js"></script>
<script>
    $(document).ready(function() {
        $('.image-prime-gallery').lightSlider({
            gallery:true,
            item:1,
            loop:false,
            thumbItem:7,
            slideMargin:0,
            enableDrag: true,
            currentPagerPosition:'center'
        });
    });
</script>

</body>
</html>
