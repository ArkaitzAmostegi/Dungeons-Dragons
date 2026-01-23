<x-admin-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6">Panel de Administración</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('admin.users') }}" class="block bg-white rounded-xl shadow p-6 hover:shadow-lg hover:bg-gray-50 transition-all cursor-pointer">
                <h2 class="text-xl font-semibold mb-2">Usuarios</h2>
                <p class="text-gray-600">
                    Cantidad total: {{ \DB::table('users')->count() }}
                </p>
                <span class="mt-2 inline-block text-blue-500 hover:underline">Ver todos</span>
            </a>

            <a href="{{ route('admin.campaigns') }}" class="block bg-white rounded-xl shadow p-6 hover:shadow-lg hover:bg-gray-50 transition-all cursor-pointer">
                <h2 class="text-xl font-semibold mb-2">Campañas</h2>
                <p class="text-gray-600">
                    Cantidad total: {{ \DB::table('campaigns')->count() }}
                </p>
                <span class="mt-2 inline-block text-blue-500 hover:underline">Ver todas</span>
            </a>

            <a href="{{ route('admin.characters') }}" class="block bg-white rounded-xl shadow p-6 hover:shadow-lg hover:bg-gray-50 transition-all cursor-pointer">
                <h2 class="text-xl font-semibold mb-2">Personajes</h2>
                <p class="text-gray-600">
                    Cantidad total: {{ \DB::table('characters')->count() }}
                </p>
                <span class="mt-2 inline-block text-blue-500 hover:underline">Ver todos</span>
            </a>
        </div>
    </div>
</x-admin-layout>
