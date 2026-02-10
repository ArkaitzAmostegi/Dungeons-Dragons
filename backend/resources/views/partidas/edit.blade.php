<x-app-layout :title="'Editar Partida'">
    <div class="page-partidas">
        <div class="card-partidas">

            <!-- Título de la página -->
            <h1 class="title">Editar Partida</h1>

            <!-- Formulario para editar la partida -->
            <form class="form-edit" method="POST" action="{{ route('partidas.update', $campaign) }}">
                @csrf
                @method('PUT') <!-- Método HTTP PUT para actualizar -->

                <!-- Campo para el nombre de la partida -->
                <label>Nombre partida</label>
                <input name="nombre" value="{{ old('nombre', $campaign->title) }}" required>

                <!-- Campo para la descripción de la partida -->
                <label>Descripción</label>
                <textarea name="descripcion">{{ old('descripcion', $campaign->description) }}</textarea>

                <!-- Selector para el modo de juego -->
                <label>Modo de juego</label>
                <select name="juego_id" required>
                    @foreach($juegos as $j)
                        <option value="{{ $j->id }}" @selected(old('juego_id', $campaign->juego_id) == $j->id)>
                            {{ $j->nombre }}
                        </option>
                    @endforeach
                </select>

                <!-- Botones de acción: Guardar o Cancelar -->
                <div class="form-actions">
                    <button type="submit" class="btn-pill">Guardar</button>
                    <a href="{{ route('partidas.index') }}" class="btn-pill btn-pill--ghost">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
