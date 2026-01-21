<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-white mb-6">
            Partidas Terminadas
        </h1>

        @if($finishedCampaigns->isEmpty())
        <p>No hay partidas finalizadas.</p>
        @else
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($finishedCampaigns as $campaign)
            <div class="p-4 border rounded-lg shadow hover:shadow-lg transition" style="background-color: #E3DFFF; color:#3A3C09">
                <h2 class="text-xl font-semibold">
                    {{ $campaign->title }}
                </h2>

                <p class="text-black-600 mb-2">
                    {{ $campaign->description }}
                </p>

                <p class="text-sm text-black font-semibold">
                    Juego: {{ $campaign->juego->nombre ?? 'N/A' }}
                </p>

                <p class="text-sm text-black font-semibold">
                    Participantes:
                    @foreach($campaign->memberships as $membership)
                    {{ $membership->user->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>

                <p class="text-sm text-black-400 mt-1">
                    Creada: {{ $campaign->created_at->format('d/m/Y') }}
                </p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>