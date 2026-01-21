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

    <!-- Vite (Tailwind/Breeze) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- jQuery UI (CSS) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <!-- CSS propio -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Loader simple -->
    <style>
        #page-loader {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
            font-size: 1.2rem;
        }

        #page-loader.hidden {
            display: none;
        }

        .spinner {
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="font-sans antialiased flex flex-col min-h-screen">

    <!-- Loader -->
    <div id="page-loader" class="hidden">
        <div class="spinner"></div>
        Cargando...
    </div>

    {{-- Navigation --}}
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>

    <!-- Loader JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.getElementById('page-loader');

            // Ocultar loader al cargar la página
            window.addEventListener('load', () => {
                if (loader) loader.classList.add('hidden');
            });

            // Mostrar loader al hacer clic en cualquier enlace interno
            document.querySelectorAll('a[href]').forEach(link => {
                link.addEventListener('click', e => {
                    if (
                        link.target === '_blank' ||
                        link.href.startsWith('#') ||
                        e.ctrlKey || e.metaKey ||
                        link.closest('form')
                    ) return;

                    e.preventDefault();
                    loader.classList.remove('hidden');

                    setTimeout(() => {
                        window.location.href = link.href;
                    }, 200); // Delay para que se vea la animación
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
