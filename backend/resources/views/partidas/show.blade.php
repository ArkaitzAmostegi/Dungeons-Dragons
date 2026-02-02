<x-app-layout :title="'Historial'">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">

        <!-- Título de la página -->
        <h1 class="text-3xl font-bold text-white mb-6">
            Partidas Terminadas
        </h1>

        <!-- Comprobar si hay partidas finalizadas -->
        @if($finishedCampaigns->isEmpty())
            <p>No hay partidas finalizadas.</p>
        @else
            <!-- Grid para mostrar las partidas en tarjetas -->
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($finishedCampaigns as $campaign)
                    <div class="p-4 border rounded-lg shadow hover:shadow-lg transition" style="background-color: #E3DFFF; color:#3A3C09">
                        
                        <!-- Título de la campaña -->
                        <h2 class="text-xl font-semibold">
                            {{ $campaign->title }}
                        </h2>

                        <!-- Descripción de la campaña -->
                        <p class="text-black-600 mb-2">
                            {{ $campaign->description }}
                        </p>

                        <!-- Juego asociado a la campaña -->
                        <p class="text-sm text-black font-semibold">
                            Juego: {{ $campaign->juego->nombre ?? 'N/A' }}
                        </p>

                        <!-- Lista de participantes -->
                        <p class="text-sm text-black font-semibold">
                            Participantes:
                            @foreach($campaign->memberships as $membership)
                                {{ $membership->user->name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>

                        <!-- Fecha de creación de la campaña -->
                        <p class="text-sm text-black-400 mt-1">
                            Creada: {{ $campaign->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
