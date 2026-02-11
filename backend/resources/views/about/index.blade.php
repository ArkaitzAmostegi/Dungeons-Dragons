<x-app-layout :title="'Acerca de'">
     @push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush
    <div id="contenedorAbout" class="max-w-2xl mx-auto p-6 space-y-6 text-center" style="background-color: var(--color-primary); color: var(--color-primary-container);">

        
        <h1 class="text-3xl font-bold text-center" style="color: var(--color-error-container);">Sobre Dragones y Mazmorras</h1>

        <p class="text-gray-800 leading-relaxed" style="color: var(--color-primary-container);">
            Dragones y Mazmorras (Dungeons & Dragons, D&D) es un juego de rol de mesa pionero en su género, donde los jugadores crean personajes únicos y se embarcan en aventuras
            en mundos de fantasía. Cada jugador interpreta a un héroe con habilidades, raza y clase determinadas, mientras que un Director de Juego (DM)
            narra la historia, controla los monstruos y el entorno, y guía la trama.
        </p>

        <p class="text-gray-800 leading-relaxed" style="color: var(--color-primary-container);">
            El juego combina imaginación, estrategia y azar, usando dados para determinar los resultados de acciones como combates, exploración y resolución de enigmas.
            Las decisiones de los jugadores afectan directamente el desarrollo de la historia, haciendo que cada partida sea única.
        </p>

        <p class="text-gray-800 leading-relaxed" style="color: var(--color-primary-container);">
            D&D tiene una gran influencia en la cultura de los juegos de rol y videojuegos modernos. Existen numerosos mundos oficiales, como 
            <strong>Forgotten Realms</strong>, <strong>Dragonlance</strong> o <strong>Eberron</strong>, cada uno con su propia historia, geografía y personajes emblemáticos. 
            Los jugadores pueden explorar mazmorras, enfrentarse a criaturas míticas, resolver acertijos, forjar alianzas y desarrollar la narrativa de forma colectiva.
        </p>

        <p class="text-gray-800 leading-relaxed" style="color: var(--color-primary-container);">
            Además de la versión de mesa, D&D ha inspirado videojuegos, series, novelas y películas, consolidándose como un fenómeno cultural que combina creatividad, rol y colaboración.
        </p>

        <div class="flex justify-center mt-6">
            <iframe width="560" height="315" 
                    src="https://www.youtube.com/embed/ale4cC9PnOQ" 
                    title="Video sobre Dragones y Mazmorras" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen
                    class="rounded-lg shadow-lg"
                    style="border: 2px solid var(--color-secondary-container);">
            </iframe>
        </div>
        <div class="flex justify-center mt-6">
            <video
                class="rounded-lg shadow-lg w-full max-w-2xl"
                style="border: 2px solid var(--color-secondary-container);"
                controls
                preload="metadata"
            >
                <source src="{{ asset('videos/DockerRaids.mp4') }}" type="video/mp4">

                {{-- Subtítulos en español (por defecto) --}}
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
        <div class="flex justify-center mt-6">
            <video
                class="rounded-lg shadow-lg w-full max-w-2xl"
                style="border: 2px solid var(--color-secondary-container);"
                controls
                preload="metadata"
            >
                <source src="{{ asset('videos/APP.mp4') }}" type="video/mp4">

                {{-- Subtítulos en español (por defecto) --}}
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
    
    </div>
</x-app-layout>
