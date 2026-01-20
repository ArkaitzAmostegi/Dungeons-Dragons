<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/anadirPartidas.css') }}">

     <div class="page-partidas">
        <div class="card-partidas">

            {{-- CONTENIDO EXACTAMENTE IGUAL --}}
            <form method="POST" action="/partidas">
                @csrf

                <!-- Nombre -->
                <div class="form-group">
                    <h2>Nombre de la partida</h2>
                    <input type="text" name="nombre" required>
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <h2>Descripcion</h2>
                    <textarea name="descripcion" placeholder="Describe la partida..."></textarea>
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
                                        <li class="personaje" draggable="true"
                                            data-id="{{ $c->id }}"
                                            data-descripcion="Nivel {{ $c->level }} | {{ $c->race?->name ?? '' }}">
                                            {{ $c->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <div class="dropzone-container">
                        <h2>Personajes seleccionados</h2>
                        <div class="dropzone" id="dropzone">
                            Arrastra aqui los personajes (Max: 5)
                        </div>
                        <input type="hidden" name="personajes" id="personajesInput">
                        <p id="personajeDescripcion" class="descripcion"></p>
                    </div>
                </div>

                <!-- Modo -->
                <div class="form-group">
                    <h2>Modo de juego</h2>
                    <select name="juego_id" id="modoSelect" required>
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
        const dropzone = document.getElementById('dropzone');
        const input = document.getElementById('personajesInput');
        const personajeDescripcion = document.getElementById('personajeDescripcion');
        let seleccionados = [];

        // Toggle de clases
        document.querySelectorAll('.class-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const ul = btn.nextElementSibling;
                ul.style.display = ul.style.display === 'none' ? 'block' : 'none';
            });
        });

        // Drag & Drop
        document.querySelectorAll('.characters-list .personaje').forEach(p => {
            p.addEventListener('dragstart', e => {
                e.dataTransfer.setData('id', p.dataset.id);
                e.dataTransfer.setData('text', p.textContent);
                e.dataTransfer.setData('descripcion', p.dataset.descripcion);
            });
        });

        dropzone.addEventListener('dragover', e => e.preventDefault());
        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            const id = e.dataTransfer.getData('id');
            const text = e.dataTransfer.getData('text');
            const desc = e.dataTransfer.getData('descripcion');

            if (seleccionados.includes(id)) return;
            if (seleccionados.length >= 5) { alert("Maximo 5 personajes"); return; }

            seleccionados.push(id);

            const div = document.createElement('div');
            div.textContent = text;
            div.className = 'personaje';
            div.addEventListener('click', () => {
                dropzone.removeChild(div);
                seleccionados = seleccionados.filter(sid => sid !== id);
                input.value = seleccionados.join(',');
            });

            dropzone.appendChild(div);
            input.value = seleccionados.join(',');
            personajeDescripcion.textContent = desc;
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
    </script>
</x-app-layout>
