<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Bestiario</h1>

        <!-- Barra de búsqueda -->
        <input type="text" id="searchInput" placeholder="Buscar monstruo..." 
               class="w-full p-2 mb-4 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

        <!-- Índice de letras -->
       <div class="flex gap-2 mb-4 overflow-x-auto whitespace-nowrap pb-2">
            <button class="letter-btn px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" data-letter="all">Todos</button>
            @foreach(range('A', 'Z') as $letter)
                <button class="letter-btn px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" data-letter="{{ $letter }}">{{ $letter }}</button>
            @endforeach
        </div>

        <!-- Grid de monstruos -->
        <ul id="monsterGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($monsters as $monster)
                <li class="monster-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 p-4 flex flex-col items-center"
                    data-name="{{ $monster['name'] }}">
                    <a href="{{ route('bestiario.show', $monster['index']) }}" class="flex flex-col items-center w-full">
                        <!-- Icono de bestia -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0118 12.5a12.083 12.083 0 01-6 3.422M12 14v7m0 0l-3-3m3 3l3-3" />
                        </svg>
                        <span class="font-semibold text-center text-gray-800">{{ $monster['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(){
            const $grid = $('#monsterGrid');
            const $cards = $grid.children();

            // Filtro por letra
            $('.letter-btn').click(function(){
                const letter = $(this).data('letter').toUpperCase();
                if(letter === 'ALL'){
                    $cards.show();
                } else {
                    $cards.each(function(){
                        const name = $(this).data('name').toUpperCase();
                        $(this).toggle(name.startsWith(letter));
                    });
                }
            });

            // Búsqueda en tiempo real
            $('#searchInput').on('input', function(){
                const query = $(this).val().toUpperCase();
                $cards.each(function(){
                    const name = $(this).data('name').toUpperCase();
                    $(this).toggle(name.includes(query));
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
