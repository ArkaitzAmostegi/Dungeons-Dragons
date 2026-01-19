<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Bestiario: {{ $monster['name'] ?? 'Sin datos' }}</h1>

        @if($monster)
            <p class="mb-2"><strong>Tamaño:</strong> {{ $monster['size'] }}</p>
            <p class="mb-2"><strong>Tipo:</strong> {{ $monster['type'] }}</p>
            <p class="mb-2"><strong>Alineamiento:</strong> {{ $monster['alignment'] }}</p>
            <p class="mb-2"><strong>Puntos de golpe:</strong> {{ $monster['hit_points'] }} ({{ $monster['hit_dice'] }})</p>

            <p class="mb-2"><strong>Clase de armadura:</strong> 
                @foreach($monster['armor_class'] as $ac)
                    {{ $ac['value'] }}@if(!$loop->last), @endif
                @endforeach
            </p>

            <p class="mb-2"><strong>Velocidad:</strong> 
                @foreach($monster['speed'] as $type => $value)
                    {{ ucfirst($type) }}: {{ $value }}@if(!$loop->last), @endif
                @endforeach
            </p>

            <p class="mb-2"><strong>Fuerza:</strong> {{ $monster['strength'] }}</p>
            <p class="mb-2"><strong>Destreza:</strong> {{ $monster['dexterity'] }}</p>
            <p class="mb-2"><strong>Constitución:</strong> {{ $monster['constitution'] }}</p>
            <p class="mb-2"><strong>Inteligencia:</strong> {{ $monster['intelligence'] }}</p>
            <p class="mb-2"><strong>Sabiduría:</strong> {{ $monster['wisdom'] }}</p>
            <p class="mb-2"><strong>Carisma:</strong> {{ $monster['charisma'] }}</p>

            @if(!empty($monster['proficiencies']))
                <p class="mb-2"><strong>Competencias:</strong> 
                    @foreach($monster['proficiencies'] as $prof)
                        {{ $prof['proficiency']['name'] }} (+{{ $prof['value'] }})@if(!$loop->last), @endif
                    @endforeach
                </p>
            @endif

            @if(!empty($monster['special_abilities']))
                <p class="mb-2"><strong>Habilidades especiales:</strong></p>
                <ul class="list-disc ms-6 mb-4">
                    @foreach($monster['special_abilities'] as $ability)
                        <li>{{ $ability['name'] }}: {{ $ability['desc'] }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($monster['actions']))
                <p class="mb-2"><strong>Acciones:</strong></p>
                <ul class="list-disc ms-6 mb-4">
                    @foreach($monster['actions'] as $action)
                        <li>{{ $action['name'] }}: {{ $action['desc'] }}</li>
                    @endforeach
                </ul>
            @endif

        @else
            <p>No se pudieron cargar los datos del monstruo.</p>
        @endif
    </div>
</x-app-layout>
