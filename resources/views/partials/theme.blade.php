<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600&display=swap">
<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }
</script>
<style>
:root{--bg:#f8efee;--card:#ffffff;--ink:#2b1d24;--mute:#7c6a72;--plum:#7b4a63;--plum2:#643a50;--side:#7b4a63;--blush:#f3e1e4;--line:#ecd8dc}
.dark{--bg:#1c1418;--card:#2a1f25;--ink:#f6ecef;--mute:#b5a2ab;--plum:#a56a85;--plum2:#8f5873;--side:#4b2b3b;--blush:#3a2a32;--line:#44323b}
body{font-family:Poppins,system-ui,sans-serif;margin:0}
.font-display{font-family:'Playfair Display',Georgia,serif}
.t-page{background:var(--bg);color:var(--ink)}
.t-card{background:var(--card);border:1px solid var(--line)}
.t-soft{background:var(--blush)}
.t-mute{color:var(--mute)}
.t-accent{color:var(--plum)}
.t-line{border-color:var(--line)}
.t-side{background:var(--side);color:#fff}
.t-on{background:rgba(255,255,255,.18)}
.t-btn{background:var(--plum);color:#fff;border-radius:9999px;padding:.6rem 1.4rem;font-weight:600;font-size:.875rem;display:inline-flex;align-items:center;justify-content:center;gap:.4rem;transition:background .2s;cursor:pointer;border:0}
.t-btn:hover{background:var(--plum2)}
.t-ghost{border:1px solid var(--plum);color:var(--plum);border-radius:9999px;padding:.6rem 1.4rem;font-weight:600;font-size:.875rem;display:inline-flex;align-items:center;gap:.4rem;background:none;cursor:pointer}
.t-input{background:var(--card);border:1px solid var(--line);color:var(--ink);border-radius:.75rem;padding:.6rem .9rem;width:100%;font-size:.875rem}
.t-input:focus{outline:2px solid var(--plum);outline-offset:1px}
.only-dark{display:none}
.dark .only-dark{display:inline}
.dark .only-light{display:none}
</style>