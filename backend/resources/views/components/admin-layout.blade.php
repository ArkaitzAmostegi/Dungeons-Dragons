<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite('resources/css/app.css') {{-- O tu CSS --}}
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <span class="font-bold text-lg">Admin Panel</span>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.index') }}" class="bg-white text-gray-800 px-4 py-2 rounded hover:bg-gray-200">
                Admin
            </a>

            {{-- Formulario de logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="p-6">
        {{ $slot }}
    </main>
</body>
</html>
