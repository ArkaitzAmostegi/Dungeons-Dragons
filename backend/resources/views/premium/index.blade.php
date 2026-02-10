<x-app-layout :title="'Contenido Premium'">

    <div class="page-premium" style="max-width:800px; margin: 2rem auto; padding: 2rem; background-color:#1f1f2e; border-radius:12px; color:#f0f0f0; box-shadow:0 4px 12px rgba(0,0,0,0.4);">

        <h1 style="font-size:2rem; margin-bottom:1rem; color:#6c63ff;">¡Gracias por ser Premium!</h1>

        <p style="font-size:1.1rem; line-height:1.6; margin-bottom:1.5rem;">
            Tu apoyo nos ayuda a seguir creando contenido de calidad. 
            Como usuario premium, tendrás acceso exclusivo a material anticipado, contenido especial y funcionalidades que no están disponibles para usuarios normales.
        </p>

        <div style="display:flex; flex-wrap:wrap; gap:1rem; margin-bottom:2rem;">
            <div style="flex:1 1 250px; padding:1rem; background-color:#2a2a3d; border-radius:8px;">
                <h2 style="color:#ffca28;">Contenido anticipado</h2>
                <p>Disfruta de nuevas funcionalidades y campañas antes que nadie.</p>
            </div>
            <div style="flex:1 1 250px; padding:1rem; background-color:#2a2a3d; border-radius:8px;">
                <h2 style="color:#ff6b6b;">Material exclusivo</h2>
                <p>Accede a personajes, escenarios y recursos que solo los usuarios premium pueden ver.</p>
            </div>
            <div style="flex:1 1 250px; padding:1rem; background-color:#2a2a3d; border-radius:8px;">
                <h2 style="color:#4fc1ff;">Soporte prioritario</h2>
                <p>Tendrás soporte y atención especial para resolver tus dudas más rápido.</p>
            </div>
        </div>

        <p style="font-style:italic; font-size:0.95rem; color:#ccc;">
            Recuerda que tu cuenta debe mantenerse activa como premium para seguir disfrutando de estos beneficios.
        </p>

        <a href="{{ route('partidas.index') }}" style="display:inline-block; margin-top:1.5rem; padding:10px 20px; background-color:#6c63ff; color:white; border-radius:8px; text-decoration:none; font-weight:600; transition:0.2s;">
            Volver a Partidas
        </a>

    </div>

</x-app-layout>
