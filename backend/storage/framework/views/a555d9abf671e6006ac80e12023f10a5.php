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

    <?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <?php $__env->stopPush(); ?>

    <div class="page-partidas">
        <div class="card-partidas">

            <h1 class="title">Mis Partidas</h1>

            <?php if($campaigns->isEmpty()): ?>
                <p class="empty">No tienes partidas aún.</p>
            <?php else: ?>
                <div id="tabs-partidas" class="tabs-partidas">
                    <ul>
                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="#tab-<?php echo e($campaign->id); ?>">
                                    <?php echo e($campaign->title); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    
                    <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $byUser = $campaign->memberships->groupBy('user_id');
                        ?>

                        <div id="tab-<?php echo e($campaign->id); ?>" class="tab-panel">
                            <div class="tab-header">
                                <div class="actions-title">
                                    <h3 class="tab-title">Partida: <?php echo e($campaign->title); ?></h3>
                                    <div class="char-actions">
                                        
                                        <form action="<?php echo e(route('partidas.finalizar', $campaign)); ?>" method="POST"
                                            onsubmit="return confirm('¿Marcar esta partida como finalizada? Se moverá al historial.');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button class="icon-btn success" type="submit" title="Finalizar">
                                                <svg viewBox="0 0 24 24" class="icon" aria-hidden="true">
                                                    <path d="M10 3h10a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H10v-2h9V5h-9V3z"/>
                                                    <path d="M10 12l-3-3v2H3v2h4v2l3-3z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        
                                        <a class="icon-btn" href="<?php echo e(route('partidas.edit', $campaign)); ?>" title="Editar">
                                            <svg viewBox="0 0 24 24" class="icon">
                                                <path d="M3 17.25V21h3.75L17.8 9.95l-3.75-3.75L3 17.25Zm18-11.5a1 1 0 0 0 0-1.4l-1.85-1.85a1 1 0 0 0-1.4 0l-1.45 1.45 3.75 3.75L21 5.75Z"/>
                                            </svg>
                                        </a>
                                        
                                        <form action="<?php echo e(route('partidas.destroy', $campaign)); ?>" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres borrar esta partida?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="icon-btn danger" type="submit" title="Borrar">
                                                <svg viewBox="0 0 24 24" class="icon">
                                                    <path d="M6 7h12l-1 14H7L6 7Zm3-3h6l1 2H8l1-2Zm-4 2h14v2H5V6Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="sub">
                                    <?php if($campaign->juego): ?>
                                        <strong>Modo de juego:</strong>
                                        <span class="js-tooltip" title="<?php echo e($campaign->juego->descripcion); ?>">
                                            <span class="badge-rol"><?php echo e($campaign->juego->nombre); ?></span>
                                        </span>
                                    <?php else: ?>
                                        <span class="js-tooltip" title="Sin modo de juego">—</span>
                                    <?php endif; ?>
                                </div>
                                <?php if($campaign->description): ?>
                                    <p class="tab-desc"><?php echo e($campaign->description); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="tab-section">
                                <h4>Jugadores y personajes</h4>

                                <?php $__currentLoopData = $byUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $u = $rows->first()->user; ?>
                                    <div class="member">
                                        <div class="member-user">
                                            <span class="sub">Jugador: <span class="tab-title"><?php echo e($u?->name ?? 'Usuario'); ?></span></span>
                                        </div>
                                        <ul class="member-chars">
                                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
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
                                                ?>

                                                <li class="char-row">
                                                    <div class="char-left">
                                                        <span class="js-tooltip" title="<?php echo e($tooltip); ?>">
                                                            <span class="sub"> Personaje - 
                                                                <span class="badge-role">
                                                                    <?php echo e($c?->name ?? 'Personaje'); ?> 
                                                                </span>
                                                            </span>
                                                        </span>

                                                        <?php
                                                            $role = $m->getAttribute('role') ?? data_get($m, 'attributes.role');
                                                        ?>

                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div style="margin:20px 10px;">
                <a href="<?php echo e(route('partidas.create')); ?>" class="btn-new-partida"
                    style="padding:8px 16px; background:#6d51b7; color:white; border-radius:8px; text-decoration:none; font-weight:600; margin-top:10px">
                    Nueva Partida
                </a>
            </div>

        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>

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
<?php /**PATH /var/www/html/resources/views/partidas/index.blade.php ENDPATH**/ ?>