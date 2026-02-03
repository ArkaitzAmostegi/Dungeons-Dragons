<x-admin-layout>
     @push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Todas las Campañas</h1>

        <div class="mb-6 text-center">
            <a href="{{ route('admin.campaigns.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Crear Nueva Campaña
            </a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full table-auto border-collapse text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-gray-700 uppercase text-sm font-medium">ID</th>
                        <th class="px-6 py-3 text-gray-700 uppercase text-sm font-medium">Nombre</th>
                        <th class="px-6 py-3 text-gray-700 uppercase text-sm font-medium">Descripción</th>
                        <th class="px-6 py-3 text-gray-700 uppercase text-sm font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($campaigns as $campaign)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-800">{{ $campaign->id }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $campaign->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $campaign->description }}</td>
                            <td class="px-6 py-4 flex justify-center">
                                <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta campaña?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .delete-btn {
            background-color: #e3342f; /* rojo */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .delete-btn:hover {
            background-color: #cc1f1a;
        }

        .delete-btn:active {
            background-color: #a71d15;
            transform: scale(0.97);
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            border: 1px solid #10b981;
            text-align: center;
        }
    </style>
</x-admin-layout>
