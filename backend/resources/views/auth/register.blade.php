<x-guest-layout>
    <div class="auth-card">
        <h1 class="auth-title">REGISTRAR</h1>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            {{-- Usuario (name) --}}
            <div class="auth-field">
                <x-input-label for="name" :value="__('Usuario')" class="auth-label" />
                <x-text-input
                    id="name"
                    class="auth-input"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error :messages="$errors->get('name')" class="auth-error" />
            </div>

            {{-- Nombre --}}
            <div class="auth-field">
                <x-input-label for="name" :value="__('Nombre')" class="auth-label" />
                <x-text-input
                    id="name"
                    class="auth-input"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autocomplete="name"
                />
                <x-input-error :messages="$errors->get('name')" class="auth-error" />
            </div>

            {{-- Email --}}
            <div class="auth-field">
                <x-input-label for="email" :value="__('Email')" class="auth-label" />
                <x-text-input
                    id="email"
                    class="auth-input"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="auth-error" />
            </div>

            {{-- Password --}}
            <div class="auth-field">
                <x-input-label for="password" :value="__('Password')" class="auth-label" />
                <x-text-input
                    id="password"
                    class="auth-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            {{-- Confirm password --}}
            <div class="auth-field">
                <x-input-label for="password_confirmation" :value="__('Confirm password')" class="auth-label" />
                <x-text-input
                    id="password_confirmation"
                    class="auth-input"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="auth-error" />
            </div>

            <div class="auth-actions">
                <x-primary-button class="auth-button">
                    {{ __('Registrar') }}
                </x-primary-button>

                <a class="auth-link auth-link-center" href="{{ route('login') }}">
                    {{ __('¿Ya tienes cuenta?') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
