<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <!--Scripts-->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <div id="shit">
                            <user-component route=" {{ route ('api.user.getFriendRequest', ['id' => Auth::user()->id]) }} "
                                like-route=" {{ route ('api.user.getLike', ['id' => Auth::user()->id]) }} "
                                comment-route= " {{ route ('api.user.getComment', ['id' => Auth::user()->id]) }} "
                                id="notification"></user-component>
                        </div>
                        <a href="{{ route('api.user.notification', ['id' => Auth::user()->id]) }}"> Notification</a>
                        <a href="{{ route('logout') }}">Logout</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))

                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                @if (Route::has('login'))
                <div class="title">
                    @auth
                        Welcome
                    @else
                        Please Log In

                    @endauth
                </div>
                @endif

                <br>
                <br>

                @if (Route::has('login'))
                <div class="links">
                    @auth
                    <a href="{{ url('/post') }}">Post</a>
                    <a href="{{ url('newsfeed')}} ">Newsfeed</a>
                    @else

                    @endauth
                </div>
                @endif
            </div>
        </div>
    </body>
</html>
