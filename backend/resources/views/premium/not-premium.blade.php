<x-app-layout :title="'Contenido Premium'">

    <div class="page-not-premium" style="max-width:700px; margin: 2rem auto; padding: 2rem; background-color:#1f1f2e; border-radius:12px; color:#f0f0f0; box-shadow:0 4px 12px rgba(0,0,0,0.4); text-align:center;">

        {{-- Mensaje de éxito después de suscribirse --}}
        @if(session('success'))
            <div style="margin-bottom:1.5rem; padding:1rem; background-color:#22c55e; color:white; border-radius:8px; font-weight:600;">
                {{ session('success') }}
            </div>
        @endif

        <h1 style="font-size:2rem; margin-bottom:1rem; color:#ff6b6b;">Contenido Premium</h1>

        <p style="font-size:1.1rem; line-height:1.6; margin-bottom:1.5rem;">
            Lo sentimos, esta sección es exclusiva para usuarios premium.
            Al ser premium, tendrás acceso anticipado a contenido especial, campañas exclusivas y soporte prioritario.
        </p>

        <div style="font-size:4rem; margin-bottom:1rem;">🔒</div>

        {{-- Lista de beneficios --}}
        <ul style="text-align:left; max-width:400px; margin:1rem auto 2rem auto; line-height:1.6;">
            <li>✅ Acceso anticipado a campañas</li>
            <li>✅ Contenido exclusivo y recursos especiales</li>
            <li>✅ Soporte prioritario</li>
        </ul>

        {{-- Formulario de suscripción --}}
        <form method="POST" action="{{ route('premium.checkout') }}">
            @csrf
            <button type="submit"
                style="display:inline-block; padding:12px 24px; background:linear-gradient(90deg,#facc15,#f59e0b); color:white; font-weight:700; border-radius:10px; transition: all 0.2s; font-size:1rem;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(255,255,255,0.3)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                Suscribirse a Premium
            </button>
        </form>

        <p style="font-size:0.95rem; color:#ccc; margin-top:1.5rem;">
            Si ya eres premium, asegúrate de iniciar sesión con la cuenta correcta.
        </p>

    </div>

</x-app-layout>
