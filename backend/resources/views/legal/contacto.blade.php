<x-app-layout :title="'Contacto'">
    <div class="page-partidas" style="align-items: flex-start; padding: 40px 16px;">
        <div class="card-partidas" style="padding: 32px; max-width: 600px; margin: 0 auto; background: var(--color-primary-container); border-radius: 12px;">
            <header>
                <h1 class="title" style="color: var(--color-primary); margin-bottom: 24px; text-align: center;">Contacto</h1>
            </header>
            <main style="color: var(--color-primary); line-height: 1.6;">
                @if(session('success'))
                    <div style="color:green; text-align:center;" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                

                <p style="text-align: center; margin-bottom: 24px;">
                    Si quieres ponerte en contacto con nosotros, completa el siguiente formulario o utiliza nuestros datos de contacto.
                </p>

                <form action="{{ route('legal.contacto.enviar') }}" method="POST" class="auth-form" style="display: flex; flex-direction: column; gap: 16px;">
                    @csrf
                    <div class="auth-field" style="display: flex; flex-direction: column;">
                        <label class="auth-label" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="auth-input" placeholder="Tu nombre" required style="padding: 10px; border-radius: 6px; border: 1px solid #ccc; width: 100%;">
                    </div>

                    <div class="auth-field" style="display: flex; flex-direction: column;">
                        <label class="auth-label" for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="auth-input" placeholder="tu@correo.com" required style="padding: 10px; border-radius: 6px; border: 1px solid #ccc; width: 100%;">
                    </div>

                    <div class="auth-field" style="display: flex; flex-direction: column;">
                        <label class="auth-label" for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" class="auth-input" placeholder="Escribe tu mensaje aquí..." required
                                  style="min-height: 140px; padding: 10px; border-radius: 6px; border: 1px solid #ccc; width: 100%; resize: vertical;"></textarea>
                    </div>

                    <div class="auth-actions" style="text-align: center; margin-top: 16px;">
                        <button type="submit" class="auth-button" style="background: var(--color-primary); color: white; padding: 10px 24px; border-radius: 6px; cursor: pointer; transition: background 0.3s;">
                            Enviar
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center" style="margin-top: 32px; color: var(--color-primary); line-height: 1.5;">
                    <p>Email: d&d@plaiaundi.com</p>
                    <p>Teléfono: +34 123 456 789</p>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
