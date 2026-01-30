<x-app-layout :title="'Crear Partida'">
    <link rel="stylesheet" href="{{ asset('css/anadirPartidas.css') }}">

    <div class="page-partidas">
        <div class="card-partidas">

            {{-- CONTENIDO EXACTAMENTE IGUAL --}}
            <form method="POST" action="/partidas">
                @csrf

                <!-- Nombre -->
                <div class="form-group">
                    <h2>Nombre de la partida</h2>
                    <input type="text" name="nombre" required aria-label="nombrePartida">
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <h2>Descripcion</h2>
                    <textarea name="descripcion" placeholder="Describe la partida..." aria-label="Descripcion"></textarea>
                </div>

                <!-- Personajes -->
                @php
                $characters = \App\Models\Character::all();
                $byClass = $characters->groupBy(fn($c) => $c->class ?? 'Sin Clase');
                @endphp

                <div class="form-group personajes-flex">
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

                    <!-- Ventana modal oculta -->
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

                <!-- Modo -->
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

                <button id="botonCrear" type="submit">Crear partida</button>
            </form>
            {{-- FIN CONTENIDO --}}

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const dropzone = document.getElementById('dropzone');
            const input = document.getElementById('personajesInput');
            const personajeDescripcion = document.getElementById('personajeDescripcion');
            let seleccionados = [];

            document.querySelectorAll('.class-toggle').forEach(btn => {
                btn.addEventListener('click', () => {
                    // nextElementSibling puede ser un nodo de texto, buscamos el siguiente UL
                    let ul = btn.nextElementSibling;
                    while (ul && ul.tagName !== 'UL') {
                        ul = ul.nextElementSibling;
                    }
                    if (!ul) return;
                    ul.style.display = ul.style.display === 'none' ? 'block' : 'none';
                });
            });

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

                if (seleccionados.includes(id)) return;
                if (seleccionados.length >= 5) {
                    alert("Maximo 5 personajes");
                    return;
                }

                seleccionados.push(id);

                const div = document.createElement('div');
                div.className = 'personaje';
                div.dataset.id = id;

                div.innerHTML = `<strong>${text}</strong><br>${info}`;

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

            function actualizarDescripcion() {
                const bonusesPorRaza = {};

                seleccionados.forEach(id => {
                    const li = document.querySelector(`.characters-list .personaje[data-id='${id}']`);
                    if (!li) return;
                    const race = li.dataset.race.toLowerCase();
                    const bonuses = li.dataset.bonuses; // dex=2,str=1 etc
                    // solo guardamos la primera ocurrencia de cada raza
                    if (!bonusesPorRaza[race]) {
                        bonusesPorRaza[race] = bonuses;
                    }
                });

                // convertir a texto
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
                    dex: "Destreza. Mejora los atributos de habilidad, velocidad y evasión.",
                    con: "Constitución. Incrementa los puntos de vida y resistencia.",
                    int: "Inteligencia. Mejora la magia y el conocimiento.",
                    wis: "Sabiduría. Aumenta la percepción y la resistencia a hechizos.",
                    cha: "Carisma. Influye en interacción social y liderazgo."
                }).map(([clave, desc]) => `<li><strong>${clave}:</strong> ${desc}</li>`).join('');
                modalGlosario.style.display = 'flex';
            });

            cerrarModal.addEventListener('click', () => modalGlosario.style.display = 'none');
            modalGlosario.addEventListener('click', e => {
                if (e.target === modalGlosario) modalGlosario.style.display = 'none';
            });

            // Modo de juego
            const modoSelect = document.getElementById('modoSelect');
            const modoDescripcion = document.getElementById('modoDescripcion');
            const modos = {
                1: 'Descubrir zonas, resolver peligros y avanzar por territorio desconocido.',
                2: 'Planificación, infiltración y escape con botin u objetivo.',
                3: 'Combate rapido y tactico contra enemigos o facciones rivales.',
                4: 'Defender o conquistar una fortaleza durante varias fases.',
                5: 'Recuperar un rehen/artefacto antes de que se agote el tiempo.'
            };
            modoSelect.addEventListener('change', () => {
                modoDescripcion.textContent = modos[modoSelect.value] || '';
            });

        });
    </script>


    <style>
        /* Modal CSS */
        .modal-glosario {
            display: none;
            /* oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-content {
            background-color: #111;
            color: #eee;
            padding: 1.5rem;
            border-radius: 10px;
            max-width: 320px;
            width: 90%;
        }

        .modal-content button {
            margin-top: 10px;
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            background-color: var(--color-secondary-container);
            color: var(--color-primary-container);
        }
        /* Botón Bonuses */
.btn-bonuses {
    background-color: #4f46e5; /* azul-violeta */
    color: #ffffff;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.2s;
    margin-left: 10px;
}

.btn-bonuses:hover {
    background-color: #6366f1; /* más claro al pasar el ratón */
    transform: scale(1.05);
}

.btn-bonuses:active {
    background-color: #4338ca; /* más oscuro al clickar */
    transform: scale(0.97);
}

    </style>

</x-app-layout>