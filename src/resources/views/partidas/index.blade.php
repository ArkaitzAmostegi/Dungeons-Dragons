<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Partidas
        </h2>
    </x-slot>

    <div class="page-partidas">
        <div class="card-partidas">
            <div class="topbar">
                <div class="user-pill">
                    {{ Auth::user()->name }}
                </div>
            </div>

            <h1 class="title">Mis Partidas</h1>

            <div class="list">
                @forelse($campaigns as $campaign)
                    <div class="row">
                        <div class="name">
                            {{ $campaign->title }}
                            <div class="sub">
                                {{ optional($campaign->juego)->nombre }}
                            </div>
                        </div>

                        <div class="actions">
                            {{-- Editar (pon aquí tu route real) --}}
                            <a class="icon-btn" href="#" title="Editar">
                                <svg viewBox="0 0 24 24" class="icon">
                                    <path d="M3 17.25V21h3.75L17.8 9.95l-3.75-3.75L3 17.25Zm18-11.5a1 1 0 0 0 0-1.4l-1.85-1.85a1 1 0 0 0-1.4 0l-1.45 1.45 3.75 3.75L21 5.75Z"/>
                                </svg>
                            </a>

                            {{-- Borrar (pon aquí tu form/route real) --}}
                            <button class="icon-btn danger" type="button" title="Borrar">
                                <svg viewBox="0 0 24 24" class="icon">
                                    <path d="M6 7h12l-1 14H7L6 7Zm3-3h6l1 2H8l1-2Zm-4 2h14v2H5V6Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="empty">No tienes partidas aún.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
