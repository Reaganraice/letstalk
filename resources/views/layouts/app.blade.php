<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Posty</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('./resources/css/app.css')
    </head>
    <body class='h-14 bg-gradient-to-r from-cyan-400 to-blue-900'>
        <nav class='p-6  flex justify-between mb-6 text-white'>
            <ul class='flex items-center'>

                <li>
                    <a href="/" class='p-3'>Home</a>
                </li>
                <li>
                    <a href="{{route('dashboard')}}" class='p-3'>Dashboard</a>
                </li>
                <li>
                    <a href="{{route('posts')}}" class='p-3'>Post</a>
                </li>
            </ul>
            <ul class='flex items-center'>
            @auth
                <li>
                    <a href="" class='p-3'>{{auth()->user()->name}}</a>
                </li>

                <form action="{{route('logout')}}"  method="post">
                @csrf
                     <button type="submit">Logout</button>
                </form>

             @endauth

             @guest
                <li>
                    <a href="{{route('login')}}" class='p-3'>Login</a>
                </li>
                <li>
                    <a href="{{route('register')}}" class='p-3'>Register</a>
                </li>
            @endguest
            </ul>
        </nav>

        @yield('content')
    </body>
</html>
