<x-app-layout :title="'Crear Partida'">
    <!-- Estilos específicos para esta página -->
    <link rel="stylesheet" href="{{ asset('css/anadirPartidas.css') }}">

    <div class="page-partidas">
        <div class="card-partidas">

            <!-- Formulario para crear una nueva partida -->
            <form method="POST" action="/partidas">
                @csrf <!-- Protección CSRF -->

                <!-- Nombre de la partida -->
                <div class="form-group">
                    <h2>Nombre de la partida</h2>
                    <input type="text" name="nombre" required aria-label="nombrePartida">
                </div>

                <!-- Descripción de la partida -->
                <div class="form-group">
                    <h2>Descripcion</h2>
                    <textarea name="descripcion" placeholder="Describe la partida..." aria-label="Descripcion"></textarea>
                </div>

                <!-- Selección de personajes -->
                @foreach($byClass as $className => $chars)


                <div class="form-group personajes-flex">

                    <!-- Lista de clases y personajes disponibles -->
                    <div class="clases-lista">
                        <h2>Clases disponibles</h2>
                        @foreach($byClass as $className => $chars)
                        <div class="class-group">
                            <button type="button" class="class-toggle">
                                {{ $className }} ({{ $chars->count() }})
                            </button>
                            <ul class="characters-list" style="display:none;">
                                @foreach($chars as $c)
                                @php
                                $bonusesText = '';
                                if (!empty($c->race?->bonuses) && is_array($c->race->bonuses)) {
                                    $bonusesText = collect($c->race->bonuses)
                                    ->map(fn($v, $k) => "$k: $v")
                                    ->implode(', ');
                                }
                                @endphp

                                <!-- Cada personaje con datos para arrastrar a la partida -->
                                <li class="personaje" draggable="true"
                                    data-id="{{ $c->id }}"
                                    data-info="Nivel {{ $c->level }} | {{ $c->race?->name ?? '' }}"
                                    data-bonuses="{{ e(collect($c->race->bonuses ?? [])->map(fn($v, $k) => "$k=$v")->implode(',')) }}"
                                    data-race="{{ $c->race?->name ?? '' }}">
                                    {{ $c->name ?? 'Sin nombre' }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>

                    <!-- Dropzone para seleccionar personajes -->
                    <div class="dropzone-container">
                        <div class="dropzone-wrapper">
                            <h2>Personajes seleccionados
                                <button type="button" id="btnGlosario" class="btn-bonuses">Bonuses</button>
                            </h2>
                            <div class="dropzone" id="dropzone">
                                Arrastra aqui los personajes (Max: 5)
                            </div>
                            <input type="hidden" name="personajes" id="personajesInput">
                            <p id="personajeDescripcion" class="descripcion"></p>
                        </div>
                    </div>

                    <!-- Modal para explicar los bonuses -->
                    <div id="modalGlosario" class="modal-glosario">
                        <div class="modal-content">
                            <h3>Glosario de Bonuses</h3>
                            <ul id="modalLista">
                                <!-- JS rellena aquí -->
                            </ul>
                            <button id="cerrarModal">Cerrar</button>
                        </div>
                    </div>

                </div>

                <!-- Selección del modo de juego -->
                <div class="form-group">
                    <h2>Modo de juego</h2>
                    <select name="juego_id" id="modoSelect" required aria-label="seleccionaModo">
                        <option value="">Selecciona un modo</option>
                        <option value="1">Exploracion</option>
                        <option value="2">Atraco</option>
                        <option value="3">Escaramuza</option>
                        <option value="4">Asedio</option>
                        <option value="5">Rescate</option>
                    </select>
                    <p id="modoDescripcion" class="descripcion"></p>
                </div>

                <!-- Botón para enviar el formulario -->
                <button id="botonCrear" type="submit">Crear partida</button>
            </form>
        </div>
    </div>

    <!-- Scripts para drag & drop, modal y descripción de personajes -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables principales
            const dropzone = document.getElementById('dropzone');
            const input = document.getElementById('personajesInput');
            const personajeDescripcion = document.getElementById('personajeDescripcion');
            let seleccionados = [];

            // Toggle de clases disponibles
            document.querySelectorAll('.class-toggle').forEach(btn => {
                btn.addEventListener('click', () => {
                    let ul = btn.nextElementSibling;
                    while (ul && ul.tagName !== 'UL') ul = ul.nextElementSibling;
                    if (!ul) return;
                    ul.style.display = ul.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Arrastrar personajes a dropzone
            document.querySelectorAll('.characters-list .personaje').forEach(p => {
                p.addEventListener('dragstart', e => {
                    e.dataTransfer.setData('id', p.dataset.id);
                    e.dataTransfer.setData('text', p.textContent);
                    e.dataTransfer.setData('info', p.dataset.info);
                    e.dataTransfer.setData('bonuses', p.dataset.bonuses);
                });
            });

            dropzone.addEventListener('dragover', e => e.preventDefault());
            dropzone.addEventListener('drop', e => {
                e.preventDefault();
                const id = e.dataTransfer.getData('id');
                const text = e.dataTransfer.getData('text');
                const info = e.dataTransfer.getData('info');

                if (seleccionados.includes(id) || seleccionados.length >= 5) return alert("Maximo 5 personajes");

                seleccionados.push(id);

                const div = document.createElement('div');
                div.className = 'personaje';
                div.dataset.id = id;
                div.innerHTML = `<strong>${text}</strong><br>${info}`;

                // Quitar personaje al hacer click
                div.addEventListener('click', () => {
                    dropzone.removeChild(div);
                    seleccionados = seleccionados.filter(sid => sid !== id);
                    input.value = seleccionados.join(',');
                    actualizarDescripcion();
                });

                dropzone.appendChild(div);
                input.value = seleccionados.join(',');
                actualizarDescripcion();
            });

            // Función para actualizar la descripción de bonuses
            function actualizarDescripcion() {
                const bonusesPorRaza = {};
                seleccionados.forEach(id => {
                    const li = document.querySelector(`.characters-list .personaje[data-id='${id}']`);
                    if (!li) return;
                    const race = li.dataset.race.toLowerCase();
                    const bonuses = li.dataset.bonuses;
                    if (!bonusesPorRaza[race]) bonusesPorRaza[race] = bonuses;
                });
                const textos = Object.entries(bonusesPorRaza)
                    .map(([race, bonuses]) => `Bonus de ${race}:${bonuses}`);
                personajeDescripcion.innerHTML = textos.join('<br>');
            }

            // Modal Bonuses
            const btnGlosario = document.getElementById('btnGlosario');
            const modalGlosario = document.getElementById('modalGlosario');
            const modalLista = document.getElementById('modalLista');
            const cerrarModal = document.getElementById('cerrarModal');

            btnGlosario.addEventListener('click', () => {
                modalLista.innerHTML = Object.entries({
                    str: "Fuerza. Aumenta el daño físico y la capacidad de carga.",
                    dex: "Destreza. Mejora la habilidad, velocidad y evasión.",
                    con: "Constitución. Incrementa los puntos de vida y resistencia.",
                    int: "Inteligencia. Mejora la magia y el conocimiento.",
                    wis: "Sabiduría. Aumenta percepción y resistencia a hechizos.",
                    cha: "Carisma. Influye en interacción social y liderazgo."
                }).map(([clave, desc]) => `<li><strong>${clave}:</strong> ${desc}</li>`).join('');
                modalGlosario.style.display = 'flex';
            });

            cerrarModal.addEventListener('click', () => modalGlosario.style.display = 'none');
            modalGlosario.addEventListener('click', e => { if (e.target === modalGlosario) modalGlosario.style.display = 'none'; });

            // Actualiza descripción del modo de juego
            const modoSelect = document.getElementById('modoSelect');
            const modoDescripcion = document.getElementById('modoDescripcion');
            const modos = {
                1: 'Exploración de zonas y resolución de peligros.',
                2: 'Planificación e infiltración.',
                3: 'Combate rápido y táctico.',
                4: 'Defender o conquistar fortaleza.',
                5: 'Recuperar un rehén o artefacto.'
            };
            modoSelect.addEventListener('change', () => { modoDescripcion.textContent = modos[modoSelect.value] || ''; });

        });
    </script>

    <!-- Estilos del modal y botón Bonuses -->
    <style>
        .modal-glosario { display: none; position: fixed; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:999; }
        .modal-content { background-color:#111; color:#eee; padding:1.5rem; border-radius:10px; max-width:320px; width:90%; }
        .modal-content button { margin-top:10px; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; background-color:var(--color-secondary-container); color:var(--color-primary-container); }
        .btn-bonuses { background-color:#4f46e5; color:#fff; border:none; padding:6px 14px; border-radius:6px; font-weight:500; cursor:pointer; transition:0.2s; margin-left:10px; }
        .btn-bonuses:hover { background-color:#6366f1; transform:scale(1.05); }
        .btn-bonuses:active { background-color:#4338ca; transform:scale(0.97); }
    </style>

</x-app-layout>
