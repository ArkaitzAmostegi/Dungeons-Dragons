<x-app-layout :title="'Editar Perfil'">

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endpush

    <div class="page-partidas">
        <div class="card-partidas">

            <h1 class="title">Mi perfil</h1>

            <div class="profile-sections">

                <div class="profile-card">
                    <h2 class="profile-title">Datos del perfil</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="profile-card">
                    <h2 class="profile-title">Cambiar contraseña</h2>
                    @include('profile.partials.update-password-form')
                </div>

                <div class="profile-card danger">
                    <h2 class="profile-title">Eliminar cuenta</h2>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
