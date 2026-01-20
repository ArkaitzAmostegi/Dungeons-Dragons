<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        @if($monster)
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Imagen -->
                @if(isset($monster['image']))
                    <img src="https://www.dnd5eapi.co{{ $monster['image'] }}" alt="{{ $monster['name'] }}" class="h-48 w-48 object-cover rounded shadow">
                @endif

                <!-- Información básica -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold mb-2">{{ $monster['name'] }}</h1>
                    <p><span class="font-medium">Tipo:</span> {{ $monster['type'] }}</p>
                    <p><span class="font-medium">Tamaño:</span> {{ $monster['size'] }}</p>
                    <p><span class="font-medium">Alineamiento:</span> {{ $monster['alignment'] }}</p>
                    <p><span class="font-medium">CR:</span> {{ $monster['challenge_rating'] }}</p>
                    <p><span class="font-medium">Puntos de vida:</span> {{ $monster['hit_points'] }} ({{ $monster['hit_dice'] }})</p>
                </div>
            </div>

            <!-- Acciones -->
            @if(!empty($monster['actions']))
                <div class="mt-6">
                    <h2 class="text-2xl font-bold mb-2">Acciones</h2>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach($monster['actions'] as $action)
                            <li>
                                <span class="font-medium">{{ $action['name'] }}:</span> {{ $action['desc'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Legendary Actions -->
            @if(!empty($monster['legendary_actions']))
                <div class="mt-6">
                    <h2 class="text-2xl font-bold mb-2">Acciones legendarias</h2>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach($monster['legendary_actions'] as $la)
                            <li>
                                <span class="font-medium">{{ $la['name'] }}:</span> {{ $la['desc'] }}
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
