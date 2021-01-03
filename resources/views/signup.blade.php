<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Create an account
                </div>

                <div class="signup">
                    <input type="text" id="name" name="name" placeholder="Name"><br><br>
                    <input type="text" id="date_of_birth" name="date_of_birth" placeholder="Date Of Birth e.g. 2000-1-1"><br><br>
                    <input type="text" id="email" name="email" placeholder="Email"><br><br>
                    <input type="text" id="password" name="password" placeholder="Password"><br><br>
                    <input type="text" id="repeat_password" name="repeat_password" placeholder="Confirm Password"><br><br>
                    <input type="submit" value="Create Account">
                </div>
            </div>
        </div>
    </body>
</html>
