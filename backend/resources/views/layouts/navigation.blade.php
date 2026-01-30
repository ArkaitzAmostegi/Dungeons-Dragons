<nav x-data="{
    open: false,
    openColor: false,
    selectedColor: localStorage.getItem('userColor') || '#22c55e',
    colorNames: {
        '#ef4444': 'Rojo',
        '#3b82f6': 'Azul',
        '#22c55e': 'Verde',
        '#facc15': 'Amarillo'
    },
    changeColor(color) {
        this.selectedColor = color;
        localStorage.setItem('userColor', color);
        this.openColor = false;
    }
}">
    <!-- Skip link -->
    <a href="#main-content" class="skip-link">Saltar al contenido</a>

    <div id="barra" class="mx-auto px-4 sm:px-6 lg:px-8" style="margin:0; width:100%;">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + Navigation Links -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" title="Ir a la página principal">
                        <img src="{{ asset('images/Logo.png') }}" class="h-16 w-auto rounded-md" alt="LogoDragon">
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" title="Mis Partidas">Mis Partidas</x-nav-link>
                    <x-nav-link href="/personajes/" :active="request()->is('personajes*')">Personajes</x-nav-link>
                    <x-nav-link :href="route('bestiario.index')" :active="request()->routeIs('bestiario.index')">Bestiario</x-nav-link>
                    <x-nav-link :href="route('partidas.show')" :active="request()->routeIs('partidas.show')">Historial</x-nav-link>
                    <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">About</x-nav-link>
                </div>
            </div>

            <!-- Right: Preferences + Profile -->
            <div class="hidden sm:flex sm:items-center space-x-4">

                <!-- Color preferences -->
                <div class="relative">
                    <button @click="openColor = !openColor"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition"
                        aria-haspopup="true" aria-expanded="false" aria-label="Preferencias de color">
                        <span class="animate-breathing"
                            :style="`--latido-color: ${selectedColor}; --latido-color-shadow: ${selectedColor}77;`">
                            Preferencias
                        </span>
                        <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openColor" @click.outside="openColor = false"
                        x-transition
                        class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                        <template x-for="color in ['#ef4444','#3b82f6','#22c55e','#facc15']" :key="color">
                            <button @click="changeColor(color)"
                                class="block w-full text-center px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-green-500"
                                :aria-label="`Cambiar color a ${colorNames[color]}`">
                                <span :style="`color: ${color}`" x-text="colorNames[color]"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition" aria-haspopup="true" aria-expanded="false" aria-label="Menú de usuario">
                            <div class="flex items-center">
                                <div class="user-status"
                                    :style="`--latido-color: ${selectedColor}; --latido-color-shadow: ${selectedColor}77;`">
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="fill-current h-4 w-4 ms-1" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Mobile hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" aria-label="Abrir menú" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Mobile menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Mis Partidas</x-responsive-nav-link>
                <x-responsive-nav-link href="/personajes/" :active="request()->is('personajes*')">Personajes</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bestiario.index')" :active="request()->routeIs('bestiario.index')">Bestiario</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partidas.show')" :active="request()->routeIs('partidas.show')">Historial</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">About</x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>

<style>
    #barra { background-color: white; }

    /* Skip link */
    .skip-link {
        position: absolute;
        top: -40px;
        left: 0;
        background: #000;
        color: #fff;
        padding: 8px;
        z-index: 1000;
        text-decoration: none;
        transition: top 0.3s ease;
    }
    .skip-link:focus {
        top: 10px;
        left: 10px;
    }

    /* Foco accesible para botones y enlaces */
button:focus, a:focus {
    outline: none; /* opcional si quieres quitar el borde */
    box-shadow: none;

    /* Cambiar el fondo de todo el body */
    background-color: #cccccc; /* gris */
    outline: 2px solid #76538B; /* Verde destacado */
    outline-offset: 2px;
}

</style>
