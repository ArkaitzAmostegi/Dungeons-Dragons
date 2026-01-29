<x-app-layout>
    <div class="page-partidas" style="align-items: flex-start; padding: 40px 16px;">
        <div class="card-partidas" style="padding: 24px 28px; background: var(--color-primary-container);">
            <header>
                <h1 class="title" style="color: var(--color-primary); margin-bottom: 24px;">Términos de Uso</h1>
            </header>
            <main style="color: var(--color-primary); line-height: 1.6;">
                <p>Bienvenido a <strong>D&D</strong>. Al acceder y utilizar nuestro sitio web o servicios, aceptas cumplir con los siguientes términos y condiciones. Si no estás de acuerdo, no utilices nuestro sitio.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">1. Uso del sitio</h2>
                <p>El contenido y los servicios de este sitio web son solo para fines informativos y personales. No puedes usar el sitio para fines ilegales, fraudulentos o no autorizados.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">2. Propiedad intelectual</h2>
                <p>Todos los textos, imágenes, logotipos, software y demás contenidos son propiedad de <strong>Tu Empresa</strong> o de terceros que nos han autorizado. Está prohibida su reproducción, distribución o uso comercial sin permiso explícito.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">3. Responsabilidad</h2>
                <p>No garantizamos la exactitud o disponibilidad del contenido y no nos hacemos responsables de daños derivados del uso del sitio.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">4. Enlaces a terceros</h2>
                <p>El sitio puede contener enlaces a páginas de terceros. No somos responsables del contenido ni de las prácticas de privacidad de esos sitios.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">5. Modificaciones</h2>
                <p>Nos reservamos el derecho de modificar estos Términos de Uso en cualquier momento. Los cambios entrarán en vigor al ser publicados en el sitio. Recomendamos revisarlos periódicamente.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">6. Ley aplicable</h2>
                <p>Estos términos se rigen por la legislación española. Cualquier disputa relacionada con el sitio será resuelta en los tribunales competentes de España.</p>

                <p style="margin-top: 24px;">Si tienes preguntas sobre nuestros Términos de Uso, contáctanos mediante nuestro: 
                    <a href="{{ route('legal.contacto') }}" class="btn-pill btn-pill--ghost" style="display: inline-block; margin-top: 12px;">Formulario de Contacto</a>
                </p>
            </main>
        </div>
    </div>
</x-app-layout>
