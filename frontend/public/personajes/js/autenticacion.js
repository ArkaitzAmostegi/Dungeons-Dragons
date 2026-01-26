document.addEventListener("DOMContentLoaded", () => renderAuth());

async function renderAuth() {
  const box = document.getElementById("navAuth");
  if (!box) return;

  try {
    const res = await fetch("/me", { headers: { Accept: "application/json" }, credentials: "include" })

    const me = await res.json();

    if (me.authenticated) {
      box.innerHTML = `<span class="nav__user">${escapeHtml(me.name)}</span>`;
    } else {
      box.innerHTML = `
        <a class="nav__btn" href="/login">Login</a>
        <a class="nav__btn nav__btn--primary" href="/register">Register</a>
      `;
    }
  } catch (e) {
    // fallback
    box.innerHTML = `
      <a class="nav__btn" href="/login">Login</a>
      <a class="nav__btn nav__btn--primary" href="/register">Register</a>
    `;
    console.error(e);
  }
}

function escapeHtml(s){
  return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}
