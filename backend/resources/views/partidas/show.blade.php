<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-4">
            Historial de Partidas Terminadas
        </h1>

        @if($finishedCampaigns->isEmpty())
            <p>No hay partidas finalizadas.</p>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($finishedCampaigns as $campaign)
                    <div class="p-4 border rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold">
                            {{ $campaign->title }}
                        </h2>

                        <p class="text-gray-600 mb-2">
                            {{ $campaign->description }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Juego: {{ $campaign->juego->name ?? 'N/A' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Participantes:
                            @foreach($campaign->memberships as $membership)
                                {{ $membership->user->name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>

                        <p class="text-sm text-gray-400 mt-1">
                            Creada: {{ $campaign->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
