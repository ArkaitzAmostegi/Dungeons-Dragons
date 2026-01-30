<footer class="bg-gray-800 text-gray-200 py-6 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
        
        {{-- Texto de copyright --}}
        <p class="text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} D&D. Todos los derechos reservados.</p>
        
        {{-- Enlaces de interés --}}
        <div class="flex flex-row gap-4">
            <a href="{{ route('legal.politicaPrivacidad') }}" class="hover:text-white text-sm">Política de privacidad</a>
            <a href="{{ route('legal.accesibilidad') }}" class="hover:text-white text-sm">Accesibilidad</a>
            <a href="{{ route('legal.terminosUso') }}" class="hover:text-white text-sm">Términos de uso</a>
            <a href="{{ route('legal.contacto') }}" class="hover:text-white text-sm">Contacto</a>
        </div>
    </div>
</footer>
