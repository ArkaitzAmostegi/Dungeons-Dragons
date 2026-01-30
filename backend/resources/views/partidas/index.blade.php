
<x-app-layout :title="'Mis Partidas'">

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush
    <div class="page-partidas">
        <div class="card-partidas">
        <div class="d20-box">
    <button id="rollD20" class="btn-d20">🎲 Tirar d20</button>
    <div id="d20" class="d20-face">20</div>
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
                            $byUser = $campaign->memberships->groupBy('user_id');
                        @endphp

                        <div id="tab-{{ $campaign->id }}" class="tab-panel">
                            <div class="tab-header">
                                <div class="actions-title">
                                    <h3 class="tab-title">{{ $campaign->title }}</h3>
                                    <div class="char-actions">
                                        {{-- FINALIZAR --}}
                                        <form action="{{ route('partidas.finalizar', $campaign) }}" method="POST"
                                            onsubmit="return confirm('¿Marcar esta partida como finalizada? Se moverá al historial.');">
                                            @csrf
                                            @method('PATCH')
                                            <button class="icon-btn success" type="submit" title="Finalizar" aria-label="Finalizar">
                                                <svg viewBox="0 0 24 24" class="icon" aria-hidden="true">
                                                    <path d="M10 3h10a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H10v-2h9V5h-9V3z"/>
                                                    <path d="M10 12l-3-3v2H3v2h4v2l3-3z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        {{-- EDITAR --}}
                                        <a class="icon-btn" href="{{ route('partidas.edit', $campaign) }}" title="Editar" aria-label="Editar">
                                            <svg viewBox="0 0 24 24" class="icon">
                                                <path d="M3 17.25V21h3.75L17.8 9.95l-3.75-3.75L3 17.25Zm18-11.5a1 1 0 0 0 0-1.4l-1.85-1.85a1 1 0 0 0-1.4 0l-1.45 1.45 3.75 3.75L21 5.75Z"/>
                                            </svg>
                                        </a>
                                        {{-- BORRAR --}}
                                        <form action="{{ route('partidas.destroy', $campaign) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres borrar esta partida?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn danger" type="submit" title="Borrar" aria-label="Borrar">
                                                <svg viewBox="0 0 24 24" class="icon">
                                                    <path d="M6 7h12l-1 14H7L6 7Zm3-3h6l1 2H8l1-2Zm-4 2h14v2H5V6Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="sub">
                                    @if($campaign->juego)
                                        <strong>Modo de juego:</strong>
                                        <span class="js-tooltip" title="{{ $campaign->juego->descripcion }}">
                                            <span class="badge-rol" style="color:white;">{{ $campaign->juego->nombre }}</span>
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
                                <h4 style="font-weight: bold;">Jugadores y personajes</h4>

                                @foreach($byUser as $userId => $rows)
                                    @php $u = $rows->first()->user; @endphp
                                    <div class="member">
                                        <div class="member-user">
                                            <span class="sub"><span class="tab-title">{{ $u?->name ?? 'Usuario' }}</span></span>
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
                                                            <span class="sub"> Personaje - 
                                                                <span class="badge-role">
                                                                    {{ $c?->name ?? 'Personaje' }} 
                                                                </span>
                                                            </span>
                                                        </span>

                                                        @php
                                                            $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                                        @endphp

                                                    </div>
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

            <div style="margin:20px 10px;">
                <a href="{{ route('partidas.create') }}" class="btn-new-partida"
                    style="padding:8px 16px; background:#6d51b7; color:white; border-radius:8px; text-decoration:none; font-weight:600; margin-top:10px">
                    Nueva Partida
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('rollD20')?.addEventListener('click', () => {
    const dice = document.getElementById('d20');

    dice.classList.remove('d20-rolling');
    void dice.offsetWidth; // reinicia animación
    dice.classList.add('d20-rolling');

    let rolls = 10;
    const interval = setInterval(() => {
        dice.textContent = Math.floor(Math.random() * 20) + 1;
        rolls--;
        if (rolls === 0) clearInterval(interval);
    }, 80);
});
        $(function() {
            $("#tabs-partidas").tabs();
            $(document).tooltip({
                items: ".js-tooltip",
                track: true,
                position: { my: "left+12 top+12", at: "left bottom" }
            });
              $("#tabs-partidas").on("tabsactivate", function () {
            document.getElementById('page-loader')?.classList.add('hidden');
        });
        });
    </script>
    @endpush

</x-app-layout>
