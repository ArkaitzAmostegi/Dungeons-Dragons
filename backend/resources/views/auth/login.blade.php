<x-guest-layout>
    <div class="auth-card">
        <h1 class="auth-title">LOGIN</h1>

        <x-auth-session-status class="auth-status" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <!-- Email -->
            <div class="auth-field">
                <x-input-label for="email" :value="__('Email')" class="auth-label" />
                <x-text-input
                    id="email"
                    class="auth-input"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="auth-error" />
            </div>

            <!-- Password -->
            <div class="auth-field">
                <x-input-label for="password" :value="__('Password')" class="auth-label" />
                <x-text-input
                    id="password"
                    class="auth-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            <!-- Remember -->
            <div class="auth-remember">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <label for="remember_me" class="auth-remember-text">{{ __('Remember me') }}</label>
            </div>

            <div class="auth-actions">
                {{-- Si no lo quieres (en la imagen no aparece), elimina este bloque --}}
                @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-primary-button class="auth-button">
                    {{ __('Entrar') }}
                </x-primary-button>
            </div>
        </form>
        <div class="auth-register">
            <span>¿No tienes cuenta?</span>
            <a href="{{ route('register') }}" class="auth-link">Regístrate</a>
        </div>
    </div>
</x-guest-layout>
<style>
    .auth-register {
        font-size: 15px;
    margin-top: 10px;
    text-align: center;
}

</style>