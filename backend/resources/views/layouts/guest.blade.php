<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

        <!-- jQuery UI (CSS) -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

        <!-- CSS propio -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-start pt-6 auth-page">
        <div class="auth-shell">
            {{-- Si NO quieres el logo en login, borra este bloque --}}
            <div class="auth-logo">
                <a href="/">
                    <img
                        src="{{ asset('images/Logo-sinfondo.png') }}"
                        alt="Dungeons & Dragons"
                        class="auth-logo-img"
                    />
                </a>
            </div>

            <div class="auth-frame">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
