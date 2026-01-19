<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

        <!-- jQuery UI (CSS) -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

        <!-- CSS propio -->
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-start pt-6 auth-page">
        <div class="auth-shell">
            
            <div class="auth-logo">
                <a href="/">
                    <img
                        src="<?php echo e(asset('images/logo-sinfondo.png')); ?>"
                        alt="Dungeons & Dragons"
                        class="auth-logo-img"
                    />
                </a>
            </div>

            <div class="auth-frame">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/resources/views/layouts/guest.blade.php ENDPATH**/ ?>