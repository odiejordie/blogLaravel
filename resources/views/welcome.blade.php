<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color:rgba(34, 40, 32, 0.19);
                color: white;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            video#bgvid{
                min-width:100%;
                min-height:100%;
                width:auto;
                height:auto;
                background: url({{ asset('img/1.jpg') }}) no-repeat top center; /* replace **image link** with your own file*/
                background-size:cover;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
            }

            .fullscreen-bg {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                overflow: hidden;
                z-index: -1;
            }

            .fullscreen-bg__video {
                position: absolute;
                top: 50%;
                left: 50%;
                width: auto;
                height: auto;
                min-width: 100%;
                min-height: 100%;
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            @media (max-width: 767px) {
                .fullscreen-bg {
                    background: url({{ asset('img/1.jpg') }}) center center / cover no-repeat;
                }

                .fullscreen-bg__video {
                    display: none;
                }
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="fullscreen-bg">
                <video class="fullscreen-bg__video" loop autoplay poster="{{ asset('img/1.jpg') }}"> 
                    <source src="{{ asset('vid/footageweb.mp4') }}" type="video/mp4" />
                </video>
            </div>

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
