<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Bestiario</h1>

        <ul class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($monsters as $monster)
                <li class="p-3 border rounded hover:bg-gray-100">
                    <a href="{{ route('bestiario.show', $monster['index']) }}">
                        {{ $monster['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
