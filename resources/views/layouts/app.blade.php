<!-- App Layout -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <script src="/js/app.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">

        <title>{{env("APP_NAME")}} - @yield("title")</title>
    </head>
    <body class="bg-gray-100">
        <!-- Page navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- The content of the page -->
        <main class="container w-screen min-h-screen mx-auto">
            {{ $slot }}
        </main>

        <!-- The footer of the page -->
        @include('layouts.footer')
    </body>
</html>
