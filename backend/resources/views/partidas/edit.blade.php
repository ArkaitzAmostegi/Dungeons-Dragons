<x-app-layout :title="'Editar Partida'">
    <div class="page-partidas">
        <div class="card-partidas">
            <h1 class="title">Editar Partida</h1>

            <form class="form-edit" method="POST" action="{{ route('partidas.update', $campaign) }}">
                @csrf
                @method('PUT')

                <label>Nombre partida</label>
                <input name="nombre" value="{{ old('nombre', $campaign->title) }}" required>

                <label>Descripción</label>
                <textarea name="descripcion">{{ old('descripcion', $campaign->description) }}</textarea>

                <label>Modo de juego</label>
                <select name="juego_id" required>
                    @foreach($juegos as $j)
                        <option value="{{ $j->id }}"
                            @selected(old('juego_id', $campaign->juego_id) == $j->id)>
                            {{ $j->nombre }}
                        </option>
                    @endforeach
                </select>

                <div class="form-actions">
                    <button type="submit" class="btn-pill">Guardar</button>
                    <a href="{{ route('partidas.index') }}" class="btn-pill btn-pill--ghost">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
