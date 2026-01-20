<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        @if($monster)
            <h1 class="text-3xl font-bold mb-4">{{ $monster['name'] }}</h1>

            @if(isset($monster['image']))
                <img src="https://www.dnd5eapi.co{{ $monster['image'] }}" alt="{{ $monster['name'] }}" class="h-48 w-48 object-cover rounded mb-4">
            @endif

            <div class="mb-4">
                <span class="font-medium">Tipo:</span> {{ $monster['type'] }}<br>
                <span class="font-medium">Tamaño:</span> {{ $monster['size'] }}<br>
                <span class="font-medium">Alineamiento:</span> {{ $monster['alignment'] }}<br>
                <span class="font-medium">CR:</span> {{ $monster['challenge_rating'] }}
            </div>

            @if(!empty($monster['hit_points']))
                <div class="mb-4">
                    <span class="font-medium">Puntos de vida:</span> {{ $monster['hit_points'] }} ({{ $monster['hit_dice'] }})
                </div>
            @endif

            @if(!empty($monster['actions']))
                <div class="mb-4">
                    <h2 class="font-bold mb-2">Acciones:</h2>
                    <ul class="list-disc list-inside">
                        @foreach($monster['actions'] as $action)
                            <li>
                                <span class="font-medium">{{ $action['name'] }}:</span> {{ $action['desc'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @else
            <p>Monstruo no encontrado.</p>
        @endif
    </div>
</x-app-layout>
