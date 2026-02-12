<x-app-layout :title="'Acerca de'">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush

    <div id="contenedorAbout"
         class="max-w-2xl mx-auto p-6 space-y-10 text-center"
         style="background-color: var(--color-primary); color: var(--color-primary-container);">

        <h1 class="text-3xl font-bold"
            style="color: var(--color-error-container);">
            Sobre Dragones y Mazmorras
        </h1>

        <p class="leading-relaxed">
            Dragones y Mazmorras (Dungeons & Dragons, D&D) es un juego de rol de mesa pionero en su género,
            donde los jugadores crean personajes únicos y se embarcan en aventuras en mundos de fantasía.
            Cada jugador interpreta a un héroe con habilidades, raza y clase determinadas, mientras que
            un Director de Juego (DM) narra la historia, controla los monstruos y el entorno, y guía la trama.
        </p>

        <p class="leading-relaxed">
            El juego combina imaginación, estrategia y azar, usando dados para determinar los resultados
            de acciones como combates, exploración y resolución de enigmas. Las decisiones de los jugadores
            afectan directamente el desarrollo de la historia, haciendo que cada partida sea única.
        </p>

        <p class="leading-relaxed">
            D&D tiene una gran influencia en la cultura de los juegos de rol y videojuegos modernos.
            Existen numerosos mundos oficiales, como <strong>Forgotten Realms</strong>,
            <strong>Dragonlance</strong> o <strong>Eberron</strong>, cada uno con su propia historia,
            geografía y personajes emblemáticos.
        </p>

        <p class="leading-relaxed">
            Además de la versión de mesa, D&D ha inspirado videojuegos, series, novelas y películas,
            consolidándose como un fenómeno cultural que combina creatividad, rol y colaboración.
        </p>

        {{-- VIDEO YOUTUBE --}}
        <div class="flex flex-col items-center">
            <h2 style="margin-top:15px;" class="text-2xl font-semibold mb-4"
                style="color: var(--color-error-container);">
                Introducción al universo D&D
            </h2>

            <iframe width="560" height="315"
                src="https://www.youtube.com/embed/ale4cC9PnOQ"
                title="Video sobre Dragones y Mazmorras"
                allowfullscreen
                class="rounded-lg shadow-lg"
                style="border: 2px solid var(--color-secondary-container);">
            </iframe>
        </div>

        {{-- VIDEO APP --}}
        <div class="flex flex-col items-center">
            <h2 style="margin-top:15px;" class="text-2xl font-semibold mb-4"
                style="color: var(--color-error-container);">
                Aplicación Web
            </h2>

            <video
                class="rounded-lg shadow-lg w-full max-w-2xl"
                style="border: 2px solid var(--color-secondary-container);"
                controls
                preload="metadata"
            >
                <source src="{{ asset('videos/APP.mp4') }}" type="video/mp4">

                <track
                    src="{{ asset('subtitles/appSubs.vtt') }}"
                    kind="subtitles"
                    srclang="es"
                    label="Español"
                    default
                >

                Tu navegador no soporta el elemento video.
            </video>
        </div>

        {{-- VIDEO DOCKER --}}
        <div class="flex flex-col items-center">
            <h2 style="margin-top:15px;" class="text-2xl font-semibold mb-4"
                style="color: var(--color-error-container);">
                RAIDS y Docker
            </h2>

            <video
                class="rounded-lg shadow-lg w-full max-w-2xl"
                style="border: 2px solid var(--color-secondary-container);"
                controls
                preload="metadata"
            >
                <source src="{{ asset('videos/DockerRaids.mp4') }}" type="video/mp4">

                <track
                    src="{{ asset('subtitles/DockerRaids.vtt') }}"
                    kind="subtitles"
                    srclang="es"
                    label="Español"
                    default
                >

                Tu navegador no soporta el elemento video.
            </video>
        </div>

    </div>
</x-app-layout>
