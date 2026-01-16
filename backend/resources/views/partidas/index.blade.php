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
                            $byUser = $campaign->memberships->groupBy('user_id');
                        @endphp

                        <div id="tab-{{ $campaign->id }}" class="tab-panel">
                            <div class="tab-header">
                                <h3 class="tab-title">{{ $campaign->title }}</h3>
                                <div class="sub">
                                    @if($campaign->juego)
                                        <strong>Modo:</strong>
                                        <span class="js-tooltip" title="{{ $campaign->juego->descripcion }}">
                                            <span class="badge-role">{{ $campaign->juego->nombre }}</span>
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
                                    @php $u = $rows->first()->user; @endphp
                                    <div class="member">
                                        <div class="member-user">
                                            <strong>{{ $u?->name ?? 'Usuario' }}</strong>
                                        </div>
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

                                                <li class="char-row">
                                                    <div class="char-left">
                                                        <span class="js-tooltip" title="{{ $tooltip }}">
                                                            <span class="badge-role">
                                                                {{ $c?->name ?? 'Personaje' }}
                                                            </span>
                                                        </span>

                                                        @php
                                                            $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                                        @endphp

                                                        @if($role)
                                                            <span class="char-role"> - {{ $role }}</span>
                                                        @endif
                                                    </div>

                                                    {{-- Acciones editar y borrar --}}
                                                    <div class="char-actions">
                                                        <a class="icon-btn" href="#" title="Editar">
                                                            <svg viewBox="0 0 24 24" class="icon">
                                                                <path d="M3 17.25V21h3.75L17.8 9.95l-3.75-3.75L3 17.25Zm18-11.5a1 1 0 0 0 0-1.4l-1.85-1.85a1 1 0 0 0-1.4 0l-1.45 1.45 3.75 3.75L21 5.75Z"/>
                                                            </svg>
                                                        </a>

                                                        <button class="icon-btn danger" type="button" title="Borrar">
                                                            <svg viewBox="0 0 24 24" class="icon">
                                                                <path d="M6 7h12l-1 14H7L6 7Zm3-3h6l1 2H8l1-2Zm-4 2h14v2H5V6Z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
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
                                                    $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                                @endphp
                                                <li>
                                                    <span class="js-tooltip" title="{{ $tooltip }}">
                                                        <span class="badge-role">{{ $c?->name ?? 'Personaje' }}</span>
                                                    </span>
                                                    @if($role)
                                                        <span class="char-role"> - {{ $role }}</span>
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

            <div style="margin:10px;">
                <a href="{{ route('añadirPartidas.index') }}" class="btn-new-partida"
                    style="padding:8px 16px; background:#6d51b7; color:white; border-radius:8px; text-decoration:none; font-weight:600; margin-top:10px">
                    Nueva Partida
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            $("#tabs-partidas").tabs();
            $(document).tooltip({
                items: ".js-tooltip",
                track: true,
                position: { my: "left+12 top+12", at: "left bottom" }
            });
        });
    </script>
    @endpush

</x-app-layout>
