<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Delicious Restaurant')</title>
    @include('partials.theme')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="t-page min-h-screen antialiased">

<header class="t-card sticky top-0 z-40 border-x-0 border-t-0 shadow-sm">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="text-3xl">👨‍🍳</span>
            <span class="font-display text-2xl font-bold italic leading-none">Delicious
                <small class="t-mute block text-[10px] font-normal not-italic">Restaurant</small>
            </span>
        </a>

        <nav class="hidden items-center gap-1 text-sm font-medium md:flex">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 't-soft' : '' }} rounded-full px-4 py-2">Home</a>
            <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 't-soft' : '' }} rounded-full px-4 py-2">Menu</a>
            <a href="{{ route('home') }}#categories" class="rounded-full px-4 py-2">Categories</a>
            <a href="{{ route('home') }}#about" class="rounded-full px-4 py-2">About Us</a>
            <a href="{{ route('home') }}#contact" class="rounded-full px-4 py-2">Contact</a>
        </nav>

        <div class="flex items-center gap-2">
            <x-theme-toggle />
            @auth
                <a href="{{ route('dashboard') }}" class="t-btn hidden sm:inline-flex">
                    {{ auth()->user()->isAdmin() ? 'Dashboard' : 'My Orders' }}
                </a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="t-ghost">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="t-btn">Login</a>
            @endauth
            <button type="button" class="t-soft flex h-9 w-9 items-center justify-center rounded-full md:hidden"
                    onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" aria-label="Menu">☰</button>
        </div>
    </div>

    <div id="mobile-nav" class="t-line hidden border-t px-4 py-3 text-sm md:hidden">
        <a href="{{ route('home') }}" class="block py-2">Home</a>
        <a href="{{ route('menu') }}" class="block py-2">Menu</a>
        <a href="{{ route('home') }}#categories" class="block py-2">Categories</a>
        <a href="{{ route('home') }}#about" class="block py-2">About Us</a>
        <a href="{{ route('home') }}#contact" class="block py-2">Contact</a>
    </div>
</header>

@if(session('success'))
    <div class="mx-auto mt-4 max-w-6xl px-4">
        <div class="rounded-xl bg-green-500/15 px-4 py-3 text-sm font-medium text-green-600">{{ session('success') }}</div>
    </div>
@endif

@yield('content')

<footer class="t-side mt-16">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 text-sm sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="font-display text-2xl font-bold italic">👨‍🍳 Delicious</div>
            <p class="mt-2 text-white/70">Good Food. Good Mood.</p>
        </div>
        <div>
            <h4 class="mb-2 font-semibold">Quick Links</h4>
            <ul class="space-y-1 text-white/70">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('home') }}#about">About Us</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="mb-2 font-semibold">Contact</h4>
            <ul class="space-y-1 text-white/70">
                <li>📍 New Valley, Egypt</li>
                <li>📞 +20 123 456 789</li>
                <li>✉️ info@delicious.com</li>
            </ul>
        </div>
        <div>
            <h4 class="mb-2 font-semibold">Follow Us</h4>
            <p class="text-white/70">Facebook · Instagram · YouTube · TikTok</p>
        </div>
    </div>
    <div class="border-t border-white/15 py-4 text-center text-xs text-white/60">
        © {{ date('Y') }} Delicious Restaurant. All rights reserved.
    </div>
</footer>

</body>
</html>