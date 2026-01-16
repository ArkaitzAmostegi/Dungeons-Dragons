<x-app-layout>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush
    <div class="page-partidas">
        <div class="card-partidas">

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
                        {{-- Tooltip modo de juego --}}
                        <div class="sub">
                            @if($campaign->juego)
                            <strong>Modo:</strong>
                            <span class="js-tooltip" title="{{ $campaign->juego->descripcion }}">
                                <span class="badge-role">{{ optional($campaign->juego)->nombre }}</span>
                            </span>
                            @else
                            <span class="js-tooltip" title="Sin modo de juego">—</span>
                            @endif
                        </div>
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
                        <div id="tab-{{ $campaign->id }}" class="tab-panel">
                            <div class="tab-header">
                                <h3 class="tab-title">{{ $campaign->title }}</h3>
                                {{-- Tooltip modo de juego --}}
                                <div class="sub">
                                    @if($campaign->juego)
                                        <strong>Modo:</strong>  
                                        <span class="js-tooltip" title="{{ $campaign->juego->descripcion }}">
                                            <span class="badge-role">{{ optional($campaign->juego)->nombre }}</span>
                                        </span>
                                    @else
                                        <span class="js-tooltip" title="Sin modo de juego">—</span>
                                    @endif
                                </div>
                                @if($campaign->description)
                                    <p class="tab-desc">{{ $campaign->description }}</p>
                                @endif
                            </div>

                            <ul class="member-chars">
                                @foreach($rows as $m)
                                <li>
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

                                    <span class="js-tooltip" title="{{ $tooltip }}">
                                        <span class="badge-role">
                                            {{ $c?->name ?? 'Personaje' }}
                                        </span>
                                    </span>
                                    @php
                                    // membership = fila de campaign_user_character
                                    $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                    @endphp

                                    @if($role)
                                    <span class="char-role"> - {{ $role }}</span>
                                    @endif

                                                    <span class="js-tooltip" title="{{ $tooltip }}">
                                                        <span class="badge-role">
                                                            {{ $c?->name ?? 'Personaje' }}
                                                        </span>
                                                    </span>
                                                    @php
                                                        // membership = fila de campaign_user_character
                                                        $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                                    @endphp

                                                    @if($role)
                                                        <span class="char-role"> - {{ $role }}</span>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            <div style="margin:10px;">
                <a href="{{ route('añadirPartidas.index') }}" class="btn-new-partida"
                    style="padding:8px 16px; background:#6d51b7; color:white; border-radius:8px; text-decoration:none; font-weight:600; margin-top:10px">
                    Nueva Partida
                </a>
            </div>

        </div>

    </div>

    {{-- JS: inicializa tabs --}}
    @push('scripts')
    <script>
        $(function() {
            $("#tabs-partidas").tabs();

            $(document).tooltip({
                items: ".js-tooltip",
                track: true,
                position: {
                    my: "left+12 top+12",
                    at: "left bottom"
                }
            });
        });
    </script>
    @endpush
</x-app-layout>