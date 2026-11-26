<button type="button" aria-label="Toggle theme"
        onclick="const d=document.documentElement.classList.toggle('dark');localStorage.theme=d?'dark':'light'"
        class="t-soft flex h-9 w-9 items-center justify-center rounded-full text-lg transition hover:scale-105">
    <span class="only-light">🌙</span>
    <span class="only-dark">☀️</span>
</button>