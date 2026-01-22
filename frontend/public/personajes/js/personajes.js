const statusEl = document.getElementById("status");
const gridEl = document.getElementById("grid");
const qEl = document.getElementById("q");

async function load() {
    statusEl.textContent = "Cargando...";
    try {
        const res = await fetch("/api/personajes", {
        headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error("HTTP " + res.status);

        const data = await res.json();
        render(data);
        statusEl.textContent = `Cargados: ${data.length}`;
    } catch (e) {
        console.error(e);
        statusEl.textContent = "Error cargando personajes";
        gridEl.innerHTML = "";
    }
    }

    function render(data) {
    const q = (qEl.value || "").toLowerCase().trim();
    const filtered = !q
        ? data
        : data.filter((p) => String(p.name ?? "").toLowerCase().includes(q));

    if (!filtered.length) {
        gridEl.innerHTML = "<p>No hay personajes.</p>";
        return;
    }

    gridEl.innerHTML = filtered
        .map(
        (p) => `
        <article class="card">
            <h3>${escapeHtml(p.name ?? "")}</h3>
            <p>Nivel: ${escapeHtml(p.level ?? "-")}</p>
            <p>Raza: ${escapeHtml(p.race?.name ?? "-")}</p>
        </article>
        `
        )
        .join("");
    }

    function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, (c) =>
        ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c])
    );
}

qEl.addEventListener("input", () => load());

load();
