(() => {
    const loader = document.getElementById("pageLoader");
    if (!loader) return;

    function show() {
        loader.classList.add("is-on");
        loader.setAttribute("aria-hidden", "false");
    }

    function hide() {
        loader.classList.remove("is-on");
        loader.setAttribute("aria-hidden", "true");
    }

    // Mostrar al clicar links internos (que cambian de página)
    document.addEventListener("click", (e) => {
        const a = e.target.closest("a");
        if (!a) return;

        const href = a.getAttribute("href");
        if (!href || href.startsWith("#")) return;

        // Si abre en nueva pestaña, no
        if (a.target === "_blank") return;

        // Evitar mailto/tel/javascript
        if (/^(mailto:|tel:|javascript:)/i.test(href)) return;

        // Si el usuario está usando ctrl/cmd/shift click, no
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        // Si es la misma URL exacta, no
        const url = new URL(a.href, window.location.origin);
        if (url.href === window.location.href) return;

        show();
    });

    // Mostrar también si la navegación se dispara por otras vías
    window.addEventListener("beforeunload", () => show());

    // Si vuelves con "atrás" y el navegador restaura desde cache
    window.addEventListener("pageshow", (e) => {
        if (e.persisted) hide();
    });
})
();
