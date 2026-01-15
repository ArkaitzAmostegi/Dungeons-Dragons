<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Partidas
        </h2>
    </x-slot>

    <div class="page-partidas">
        <div class="card-partidas">

            <div class="topbar">
                <div class="user-pill">{{ Auth::user()->name }}</div>
            </div>

            <h1 class="title">Mis Partidas</h1>

            @if($campaigns->isEmpty())
                <p class="empty">No tienes partidas aún.</p>
            @else
                <div id="tabs-partidas" class="tabs-partidas">
                    <ul>
                        @foreach($campaigns as $campaign)
                            <li>
                                <a href="#tab-{{ $campaign->id }}">
                                    {{ $campaign->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    @foreach($campaigns as $campaign)
                        @php
                            // Agrupamos memberships por usuario para mostrar “User -> sus personajes”
                            $byUser = $campaign->memberships->groupBy('user_id');
                        @endphp

                        <div id="tab-{{ $campaign->id }}" class="tab-panel">
                            <div class="tab-header">
                                <h3 class="tab-title">{{ $campaign->title }}</h3>
                                <p class="tab-mode">
                                    <strong>Modo:</strong> {{ optional($campaign->juego)->nombre }}
                                </p>
                                @if($campaign->description)
                                    <p class="tab-desc">{{ $campaign->description }}</p>
                                @endif
                            </div>

                            <div class="tab-section">
                                <h4>Jugadores y personajes</h4>

                                @foreach($byUser as $userId => $rows)
                                    @php
                                        $u = $rows->first()->user;
                                    @endphp

                                    <div class="member">
                                        <div class="member-user">
                                            <strong>{{ $u?->name ?? 'Usuario' }}</strong>
                                        </div>

                                        <ul class="member-chars">
                                            @foreach($rows as $m)
                                                <li>
                                                    {{ $m->character?->name ?? 'Personaje' }}
                                                    @if($m->role)
                                                        <span class="badge-role">{{ $m->role }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    {{-- JS: inicializa tabs --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && jQuery.fn && jQuery.fn.tabs) {
                jQuery("#tabs-partidas").tabs();
            }
        });
    </script>
</x-app-layout>
