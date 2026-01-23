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

    <div id="barra" class="mx-auto px-4 sm:px-6 lg:px-8" style="margin:0px; width:100%;">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + Navigation Links -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/Logo.png') }}" class="h-16 w-auto rounded-md" alt="LogoDragon">
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Mis Partidas</x-nav-link>
                    <x-nav-link :href="route('bestiario.index')" :active="request()->routeIs('bestiario.index')">Bestiario</x-nav-link>
                    <x-nav-link :href="route('partidas.show')" :active="request()->routeIs('partidas.show')">Historial</x-nav-link>
                    <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">About</x-nav-link>
                </div>
            </div>

            <!-- Right: Settings Dropdown + Respirar -->
            <div class="hidden sm:flex sm:items-center space-x-4">

                <!-- Botón Preferencias -->
                <div class="relative">
                    <button @click="openColor = !openColor"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <span class="animate-breathing"
                            :style="`--latido-color: ${selectedColor}; --latido-color-shadow: ${selectedColor}77;`">
                            Preferencias
                        </span>
                        <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openColor" @click.outside="openColor = false"
                        class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                        style="display: none;">
                        <template x-for="color in ['#ef4444','#3b82f6','#22c55e','#facc15']" :key="color">
                            <button @click="changeColor(color)"
                                class="block w-full text-center px-4 py-2 hover:bg-gray-100">
                                <span :style="`color: ${color}`" x-text="colorNames[color]"></span>
                            </button>
                        </template>

                    </div>
                </div>

                <!-- Dropdown de perfil -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <!-- Aquí usamos selectedColor desde nav -->
                                <div class="user-status"
                                    :style="`--latido-color: ${selectedColor}; --latido-color-shadow: ${selectedColor}77;`">
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" aria-label="Abrir menú" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
<style>
    #barra {
        background-color: white;
    }
</style>