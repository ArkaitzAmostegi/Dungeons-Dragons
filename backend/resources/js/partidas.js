const modos = {
    1: 'Partida tradicional centrada en narrativa e interpretación.',
    2: 'Historia corta que se completa en una sola sesión.',
    3: 'Aventura larga con progresión de personajes.',
    4: 'Alta dificultad, decisiones permanentes y consecuencias reales.'
};

modoSelect.addEventListener('change', () => {
    modoDescripcion.textContent = modos[modoSelect.value] || '';
});
