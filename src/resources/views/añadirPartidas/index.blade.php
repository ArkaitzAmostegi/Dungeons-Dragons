<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear partida</title>
    <link rel="stylesheet" href="{{ asset('css/anadirPartidas.css') }}">
</head>

<body>
    <div class="page">


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
            <div class="form-group">
                <h2>Personajes</h2>

                <div class="personajes-container">
                    <div class="lista">
                        <div class="personaje" draggable="true" data-id="1" data-descripcion="Luchador resistente, especialista en combate cuerpo a cuerpo.">
                            Guerrero
                        </div>
                        <div class="personaje" draggable="true" data-id="2" data-descripcion="Maestro de la magia, inflige daño a distancia con hechizos.">
                            Mago
                        </div>
                        <div class="personaje" draggable="true" data-id="3" data-descripcion="Ágil y sigiloso, experto en trampas y ataques críticos.">
                            Pícaro
                        </div>
                        <div class="personaje" draggable="true" data-id="4" data-descripcion="Furioso combatiente, muy resistente y poderoso en el ataque físico.">
                            Barbaro
                        </div>
                        <div class="personaje" draggable="true" data-id="5" data-descripcion="Conecta con la naturaleza, capaz de curar y usar magia elemental.">
                            Druida
                        </div>
                        <div class="personaje" draggable="true" data-id="6" data-descripcion="Utiliza hechizos para causar daño a distancia o alterar la realidad.">
                            Hechicero
                        </div>
                        <div class="personaje" draggable="true" data-id="7" data-descripcion="Especialista en artes marciales, combina agilidad y fuerza física.">
                            Monje
                        </div>
                        <div class="personaje" draggable="true" data-id="8" data-descripcion="Explorador del bosque, experto en arquería y supervivencia.">
                            Guardabosques
                        </div>
                        <div class="personaje" draggable="true" data-id="9" data-descripcion="Usuario de magia oscura, mezcla hechizos de daño y maldiciones.">
                            Brujo
                        </div>
                    </div>

                    <div class="dropzone" id="dropzone">
                        Arrastra aqui los personajes (Max: 5)
                    </div>
                    @error('personajes')
                    <p style="color:red; font-size:14px;">{{ $message }}</p>
                    @enderror

                </div>

                <p id="personajeDescripcion" class="descripcion"></p>

                <input type="hidden" name="personajes" id="personajesInput">
            </div>

            <!-- Modo -->
            <div class="form-group">
                <h2>Modo de juego</h2>
                <select name="juego_id" id="modoSelect" required>
                    <option value="">Selecciona un modo</option>
                    <option value="1">Exploración</option>
                    <option value="2">Atraco</option>
                    <option value="3">Escaramuza</option>
                    <option value="4">Asedio</option>
                    <option value="5">Rescate</option>
                </select>

                <p id="modoDescripcion" class="descripcion"></p>
            </div>

            <button type="submit">Crear partida</button>
        </form>

        <script>
            const personajes = document.querySelectorAll('.personaje');
            const dropzone = document.getElementById('dropzone');
            const input = document.getElementById('personajesInput');
            const personajeDescripcion = document.getElementById('personajeDescripcion');

            let seleccionados = [];

            personajes.forEach(p => {
                p.addEventListener('dragstart', e => {
                    e.dataTransfer.setData('id', p.dataset.id);
                    e.dataTransfer.setData('text', p.textContent);
                });

                p.addEventListener('click', () => {
                    personajeDescripcion.textContent = p.dataset.descripcion;
                });
            });

            dropzone.addEventListener('dragover', e => {
                e.preventDefault();
                dropzone.classList.add('over');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('over');
            });

            dropzone.addEventListener('drop', e => {
                e.preventDefault();
                dropzone.classList.remove('over');

                const id = e.dataTransfer.getData('id');
                const text = e.dataTransfer.getData('text');
                if (seleccionados.length >= 5) {
                    alert("Solo puedes seleccionar un máximo de 5 personajes.");
                    return;
                }

                if (!seleccionados.includes(id)) {
                    seleccionados.push(id);

                    const div = document.createElement('div');
                    div.textContent = text;
                    div.className = 'personaje';
                    div.style.cursor = 'pointer';

                    // Al hacer clic en el personaje de la dropzone, se elimina
                    div.addEventListener('click', () => {
                        dropzone.removeChild(div);
                        seleccionados = seleccionados.filter(sid => sid !== id);
                        input.value = seleccionados.join(',');
                    });

                    dropzone.appendChild(div);
                    input.value = seleccionados.join(',');
                }
            });

            const modoSelect = document.getElementById('modoSelect');
            const modoDescripcion = document.getElementById('modoDescripcion');

            const modos = {
                1: 'Descubrir zonas, resolver peligros y avanzar por territorio desconocido.',
                2: 'Planificación, infiltración y escape con botín u objetivo.',
                3: 'Combate rápido y táctico contra enemigos o facciones rivales.',
                4: 'Defender o conquistar una fortaleza durante varias fases.',
                5: 'Recuperar un rehén/artefacto antes de que se agote el tiempo.'
            };

            modoSelect.addEventListener('change', () => {
                modoDescripcion.textContent = modos[modoSelect.value] || '';
            });
        </script>
    </div>
    <script src="{{ asset('js/partidas.js') }}"></script>

</body>

</html>