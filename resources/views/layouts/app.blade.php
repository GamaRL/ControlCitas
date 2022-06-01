<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <script src="/js/app.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">

        <title>{{env("APP_NAME")}} - @yield("title")</title>
    </head>
    <body class="bg-gray-100">
        @include('layouts.navigation')
        <main class="container w-screen h-screen mx-auto">
            @yield('content')
        </main>
        <div class="bg-indigo-900 p-2 pl-6">
            <p class="bottom text-white text-center md:text-left">© Copyright 2022 - ProSoft</p>
        </div>
    </body>
</html>
