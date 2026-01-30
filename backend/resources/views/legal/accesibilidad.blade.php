<x-app-layout :title="'Declaración de accesibilidad'">
    <div class="page-partidas" style="align-items: flex-start; padding: 40px 16px;">
        <div class="card-partidas" style="padding: 24px 28px; background: var(--color-primary-container);">

            <header>
                <h1 class="title" style="color: var(--color-primary); margin-bottom: 24px;">
                    Declaración de accesibilidad
                </h1>
            </header>

            <main style="color: var(--color-primary); line-height: 1.6;">
                <p>
                    El presente sitio web, <strong>Dungeons &amp; Dragons (proyecto académico)</strong>, se ha diseñado con el objetivo
                    de ser accesible al mayor número de personas posible, de acuerdo con los requisitos de accesibilidad aplicables.
                </p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">
                    Situación de cumplimiento
                </h2>
                <p>
                    Este sitio web es parcialmente conforme con las Pautas de Accesibilidad para el Contenido Web (WCAG) 2.1,
                    nivel AA, debido a las excepciones y falta de conformidad que se indican a continuación.
                </p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">
                    Contenido no accesible
                </h2>
                <p>El contenido que se recoge a continuación no es accesible por lo siguiente:</p>
                <ul style="padding-left: 20px; margin-bottom: 16px;">
                    <li>
                        <strong>Contraste de color:</strong> en determinadas vistas, algunos enlaces o textos pueden no alcanzar
                        el contraste mínimo exigido (WCAG 1.4.3).
                    </li>
                    <li>
                        <strong>Componentes personalizados:</strong> algunos controles personalizados (por ejemplo, menús, pestañas
                        o botones de icono) pueden no exponer completamente nombre/rol/estado a tecnologías de apoyo (WCAG 4.1.2).
                    </li>
                    <li>
                        <strong>Mensajes de estado:</strong> ciertos mensajes dinámicos (carga/éxito/error) pueden no anunciarse
                        correctamente sin mover el foco (WCAG 4.1.3).
                    </li>
                    <li>
                        <strong>Contenido de terceros (si aplica):</strong> componentes o librerías externas podrían no cumplir
                        totalmente los requisitos de accesibilidad.
                    </li>
                </ul>
                <p style="margin-bottom: 16px;">Estamos trabajando en la corrección progresiva de estos puntos.</p>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">
                    Preparación de la presente declaración
                </h2>
                <p>Esta declaración fue preparada el <strong>30 de enero de 2026</strong>.</p>
                <p style="margin-top: 12px;">El método empleado para preparar la declaración ha sido una auto-evaluación, utilizando:</p>
                <ul style="padding-left: 20px; margin-bottom: 16px;">
                    <li>Validación de HTML (Nu HTML Checker/W3C)</li>
                    <li>Herramientas de comprobación automática (por ejemplo WAVE/Lighthouse)</li>
                    <li>Revisión manual con teclado</li>
                    <li>Pruebas con lector de pantalla (por ejemplo NVDA)</li>
                </ul>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">
                    Observaciones y datos de contacto
                </h2>
                <p>
                    Si encuentras barreras de accesibilidad en este sitio web o deseas comunicar incidencias, puedes contactar mediante:
                </p>
                <ul style="padding-left: 20px; margin-bottom: 16px;">
                    <li>Correo electrónico: <strong>arkaitzamostegi@gmail.com</strong></li>
                    <li>Asunto: <strong>“Accesibilidad – Dungeons &amp; Dragons”</strong></li>
                </ul>

                <h2 style="color: var(--color-tertiary); margin-top: 24px; margin-bottom: 12px;">
                    Procedimiento de reclamación (entorno académico)
                </h2>
                <p style="margin-bottom: 24px;">
                    En caso de no recibir respuesta o no quedar satisfecho con la misma, puedes comunicarlo al equipo docente responsable
                    del proyecto en tu centro educativo, aportando la URL y una descripción del problema.
                </p>

                <p>
                    Para cualquier duda adicional, puedes usar nuestro:
                    <a href="{{ route('legal.contacto') }}" class="btn-pill btn-pill--ghost" style="margin-top: 12px; display: inline-block;">
                        Formulario de Contacto
                    </a>
                </p>
            </main>
        </div>
    </div>
</x-app-layout>
