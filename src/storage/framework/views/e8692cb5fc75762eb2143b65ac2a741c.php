<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/anadirPartidas.css')); ?>">

    <div class="page">

        <form method="POST" action="/partidas">
            <?php echo csrf_field(); ?>

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

            <!-- Personajes: lista y dropzone paralelos -->
            <?php
                $characters = \App\Models\Character::all();
                $byClass = $characters->groupBy(fn($c) => $c->class ?? 'Sin Clase');
            ?>

            <div class="form-group personajes-flex">
                <!-- Lista de clases y personajes -->
                <div class="clases-lista">
                    <h2>Clases disponibles</h2>
                    <?php $__currentLoopData = $byClass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $className => $chars): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="class-group">
                            <button type="button" class="class-toggle">
                                <?php echo e($className); ?> (<?php echo e($chars->count()); ?>)
                            </button>
                            <ul class="characters-list" style="display:none;">
                                <?php $__currentLoopData = $chars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="personaje" draggable="true"
                                        data-id="<?php echo e($c->id); ?>"
                                        data-descripcion="Nivel <?php echo e($c->level); ?> | <?php echo e($c->race?->name ?? ''); ?>">
                                        <?php echo e($c->name); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Dropzone -->
                <div class="dropzone-container">
                    <h2>Personajes seleccionados</h2>
                    <div class="dropzone" id="dropzone">
                        Arrastra aquí los personajes (Max: 5)
                    </div>
                    <input type="hidden" name="personajes" id="personajesInput">
                    <p id="personajeDescripcion" class="descripcion"></p>
                    <?php $__errorArgs = ['personajes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="error-message"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
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
            if (seleccionados.length >= 5) { alert("Máximo 5 personajes"); return; }

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
            2: 'Planificación, infiltración y escape con botín u objetivo.',
            3: 'Combate rápido y táctico contra enemigos o facciones rivales.',
            4: 'Defender o conquistar una fortaleza durante varias fases.',
            5: 'Recuperar un rehén/artefacto antes de que se agote el tiempo.'
        };
        modoSelect.addEventListener('change', () => {
            modoDescripcion.textContent = modos[modoSelect.value] || '';
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/añadirPartidas/create.blade.php ENDPATH**/ ?>