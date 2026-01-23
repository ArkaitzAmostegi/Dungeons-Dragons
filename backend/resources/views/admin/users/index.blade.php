<x-admin-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Usuarios</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-6 shadow text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow rounded-lg">
            <table class="w-full table-auto border-collapse text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-gray-700 uppercase text-sm font-medium">ID</th>
                        <th class="px-4 py-3 text-gray-700 uppercase text-sm font-medium">Nombre</th>
                        <th class="px-4 py-3 text-gray-700 uppercase text-sm font-medium">Email</th>
                        <th class="px-4 py-3 text-gray-700 uppercase text-sm font-medium">Rol</th>
                        <th class="px-4 py-3 text-gray-700 uppercase text-sm font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 text-gray-800">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $user->role }}</td>
                            <td class="px-4 py-3 flex justify-center">
                                <form class="inline-block" action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
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
        }
    </style>
</x-admin-layout>
