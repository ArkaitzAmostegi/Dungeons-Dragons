<x-app-layout :title="'Suscripción Premium'">

    <div class="page-premium-checkout" style="max-width:600px; margin: 3rem auto; padding: 2rem; background-color:#1f1f2e; border-radius:12px; color:#f0f0f0; box-shadow:0 4px 12px rgba(0,0,0,0.4); text-align:center;">

        <h1 style="font-size:2rem; margin-bottom:1rem; color:#ffb400;">Suscribirse a Premium</h1>

        <p style="font-size:1.1rem; line-height:1.6; margin-bottom:2rem;">
            Con la suscripción Premium obtendrás:
        </p>

        <ul style="text-align:left; margin-bottom:2rem; font-size:1.05rem;">
            <li>✅ Acceso anticipado a contenido exclusivo</li>
            <li>✅ Campañas especiales solo para premium</li>
            <li>✅ Soporte prioritario</li>
        </ul>

        <form method="POST" action="{{ route('premium.activate') }}">
            @csrf
            <button type="submit"
                class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600 transition">
                Confirmar Suscripción
            </button>
        </form>

        <p style="font-size:0.9rem; color:#ccc; margin-top:1.5rem;">
            Al suscribirte, tu cuenta será marcada como Premium.
        </p>

    </div>

</x-app-layout>
