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

            @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
            @endif

            <div class="list">
                @forelse($campaigns as $campaign)
                <div class="row">
                    <div class="name">
                        {{ $campaign->title }}
                        <div class="sub">{{ optional($campaign->juego)->nombre }}</div>
                    </div>

                    @php
                        $byUser = $campaign->memberships->groupBy('user_id');
                    @endphp

                    <div id="tabs-partidas-{{ $campaign->id }}" class="tabs-partidas">
                        <div class="tab-header">
                            <h3>{{ $campaign->title }}</h3>
                            @if($campaign->juego)
                            <strong>Modo:</strong>
                            <span class="js-tooltip" title="{{ $campaign->juego->descripcion }}">
                                {{ $campaign->juego->nombre }}
                            </span>
                            @endif
                            @if($campaign->description)
                            <p>{{ $campaign->description }}</p>
                            @endif
                        </div>

                        <div class="tab-section">
                            <h4>Jugadores y personajes</h4>

                            @foreach($byUser as $userId => $rows)
                            @php $u = $rows->first()->user; @endphp
                            <div class="member">
                                <strong>{{ $u?->name ?? 'Usuario' }}</strong>
                                <ul class="member-chars">
                                    @foreach($rows as $m)
                                    @php
                                        $c = $m->character;
                                        $tooltip = $c
                                            ? trim(
                                                $c->name
                                                . ($c->race?->name ? " | Raza: {$c->race->name}" : "")
                                                . " | Nivel: {$c->level}"
                                                . ($c->class ? " | Clase: {$c->class}" : "")
                                                . ($c->description ? " — {$c->description}" : "")
                                            )
                                            : "Personaje no disponible";
                                    @endphp
                                    <li>
                                        <span class="ui-tooltip" title="{{ $tooltip }}">
                                            <span class="badge-role">{{ $c?->name ?? 'Personaje' }}</span>
                                        </span>
                                        @if($m->role)
                                        <span> - {{ $m->role }}</span>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <p class="empty">No tienes partidas aún.</p>
                @endforelse
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            $(".tabs-partidas").tabs();

            $(document).tooltip({
                items: ".ui-tooltip",
                track: true,
                position: { my: "left+12 top+12", at: "left bottom" }
            });
        });
    </script>
    @endpush
</x-app-layout>
