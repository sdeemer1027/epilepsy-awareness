<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Epilepsy Support Platform')</title>

    <meta name="description"
          content="Epilepsy Support Platform - Support. Empower. Together.">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body>

    @include('partials.guest-navigation')

    <main class="esp-page">

    @yield('content')

    {{ $slot ?? '' }}

</main>

    @include('partials.footer')

</body>

</html>