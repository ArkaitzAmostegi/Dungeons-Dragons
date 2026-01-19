@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Bestiario: {{ $spell['name'] ?? 'Sin datos' }}</h1>

    @if($spell)
        <p class="mb-2"><strong>Descripción:</strong></p>
        <ul class="mb-4 list-disc ms-6">
            @foreach($spell['desc'] as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>

        <p class="mb-2"><strong>Nivel:</strong> {{ $spell['level'] }}</p>
        <p class="mb-2"><strong>Escuela:</strong> {{ $spell['school']['name'] }}</p>
        <p class="mb-2"><strong>Tiempo de lanzamiento:</strong> {{ $spell['casting_time'] }}</p>
        <p class="mb-2"><strong>Alcance:</strong> {{ $spell['range'] }}</p>
        <p class="mb-2"><strong>Componentes:</strong> {{ implode(', ', $spell['components']) }}</p>
        @if(!empty($spell['material']))
            <p class="mb-2"><strong>Material:</strong> {{ $spell['material'] }}</p>
        @endif
    @else
        <p>No se pudieron cargar los datos del bestiario.</p>
    @endif
</div>
@endsection
