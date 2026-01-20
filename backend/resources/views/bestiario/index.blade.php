<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Bestiario</h1>

        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <input 
                type="text" 
                id="search" 
                placeholder="Buscar monstruo..." 
                class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
            >
        </div>

        <!-- Índice de letras -->
        @php $letters = range('A', 'Z'); @endphp
        <div class="flex flex-wrap justify-center gap-2 mb-6">
            @foreach($letters as $letter)
                <button type="button" class="letter-btn px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm" data-letter="{{ $letter }}">
                    {{ $letter }}
                </button>
            @endforeach
            <button type="button" class="letter-btn px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm" data-letter="*">Todos</button>
        </div>

        <!-- Grid de monstruos -->
        <ul id="monster-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 justify-items-center">
            @foreach($monsters as $monster)
                <li class="monster-card border rounded-lg shadow hover:shadow-lg transition flex flex-col items-center p-3 w-full max-w-[150px]" data-name="{{ $monster['name'] }}">
    <a href="{{ route('bestiario.show', $monster['index']) }}" class="flex flex-col items-center w-full">
        <div class="h-24 w-24 bg-gray-200 flex items-center justify-center rounded mb-2">?</div>
        <span class="font-medium text-sm text-center">{{ $monster['name'] }}</span>
    </a>
</li>
            @endforeach
        </ul>
    </div>

    <!-- Scripts de búsqueda e índice de letras -->
    <script>
        const searchInput = document.getElementById('search');
        const cards = Array.from(document.getElementsByClassName('monster-card'));
        const letterButtons = Array.from(document.getElementsByClassName('letter-btn'));

        // Filtrado por barra de búsqueda
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            cards.forEach(card => {
                const name = card.innerText.toLowerCase();
                card.style.display = name.includes(query) ? 'flex' : 'none';
            });
        });

        // Filtrado por índice de letras
        letterButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const letter = this.getAttribute('data-letter');
        searchInput.value = ''; // limpiar búsqueda
        cards.forEach(card => {
            const name = card.getAttribute('data-name').trim();
            if(letter === '*') {
                card.style.display = 'flex';
            } else {
                card.style.display = name.toUpperCase().startsWith(letter) ? 'flex' : 'none';
            }
        });
    });
});

    </script>
</x-app-layout>
