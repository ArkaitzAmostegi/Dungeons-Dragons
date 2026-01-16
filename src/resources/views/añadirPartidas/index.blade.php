<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear partida</title>
    <style>
        /* ===== MOBILE FIRST ===== */
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 15px;
        }

        h2 {
            margin-bottom: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            /* mejor para móvil */
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .personajes-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .lista,
        .dropzone {
            width: 100%;
            min-height: 160px;
            padding: 10px;
            border-radius: 6px;
        }

        .lista {
            background: #fff;
            border: 1px solid #ccc;
        }

        .dropzone {
            background: #e0e0e0;
            border: 2px dashed #999;
            text-align: center;
        }

        .personaje {
            padding: 10px;
            margin-bottom: 8px;
            background: #d9edf7;
            border-radius: 4px;
            cursor: grab;
            font-size: 15px;
        }

        .dropzone.over {
            border-color: #333;
        }

        .descripcion {
            margin-top: 8px;
            font-style: italic;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
        }

        /* ===== TABLET / DESKTOP ===== */
        @media (min-width: 768px) {
            body {
                padding: 30px;
            }

            .personajes-container {
                flex-direction: row;
                gap: 30px;
            }

            .lista,
            .dropzone {
                width: 250px;
                min-height: 200px;
            }

            button {
                width: auto;
            }

            /* CONTENEDOR DESKTOP */
            .page {
                max-width: 520px;
                margin: 0 auto;
            }

            /* DESKTOP MÁS GRANDE */
            @media (min-width: 1024px) {
                .page {
                    max-width: 600px;
                }
            }

        }
    </style>
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
                <h2>Descripción</h2>
                <textarea name="descripcion" placeholder="Describe la partida..."></textarea>
            </div>

            <!-- Personajes -->
            <div class="form-group">
                <h2>Personajes</h2>

                <div class="personajes-container">
                    <div class="lista">
                        <div class="personaje" draggable="true" data-id="1" data-descripcion="Experto en combate cuerpo a cuerpo. Alta resistencia.">
                            Guerrero
                        </div>
                        <div class="personaje" draggable="true" data-id="2" data-descripcion="Especialista en hechizos y daño mágico.">
                            Mago
                        </div>
                        <div class="personaje" draggable="true" data-id="3" data-descripcion="Sigilo, trampas y ataques críticos.">
                            Pícaro
                        </div>
                        <div class="personaje" draggable="true" data-id="4" data-descripcion="Apoyo, curación y magia divina.">
                            Clérigo
                        </div>
                    </div>

                    <div class="dropzone" id="dropzone">
                        Arrastra aquí los personajes
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
                    <option value="1">Rol clásico</option>
                    <option value="2">One-shot</option>
                    <option value="3">Campaña larga</option>
                    <option value="4">Hardcore</option>
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

                if (!seleccionados.includes(id)) {
                    seleccionados.push(id);

                    const div = document.createElement('div');
                    div.textContent = text;
                    div.className = 'personaje';
                    div.style.cursor = 'default';

                    dropzone.appendChild(div);
                    input.value = seleccionados.join(',');
                }
            });

            const modoSelect = document.getElementById('modoSelect');
            const modoDescripcion = document.getElementById('modoDescripcion');

            const modos = {
                rol: 'Partida tradicional centrada en narrativa e interpretación.',
                'one-shot': 'Historia corta que se completa en una sola sesión.',
                campaña: 'Aventura larga con progresión de personajes.',
                hardcore: 'Alta dificultad, decisiones permanentes y consecuencias reales.'
            };

            modoSelect.addEventListener('change', () => {
                modoDescripcion.textContent = modos[modoSelect.value] || '';
            });
        </script>
    </div>
    <script src="{{ asset('js/partidas.js') }}"></script>

</body>

</html>