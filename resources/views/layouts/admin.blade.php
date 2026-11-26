<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · Delicious</title>
    @include('partials.theme')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="t-page min-h-screen antialiased">

@php
    $nav = [
        ['admin.dashboard', 'Dashboard', '🏠', 'admin.dashboard'],
        ['restaurants.index', 'Meals', '🍽️', 'restaurants.*'],
        ['orders.index', 'Orders', '🧾', 'orders.*'],
    ];
@endphp

<aside id="sidebar" class="t-side fixed inset-y-0 left-0 z-50 flex w-60 -translate-x-full flex-col px-4 py-6 transition-transform lg:translate-x-0">
    <a href="{{ route('home') }}" class="mb-8 block text-center">
        <div class="text-4xl">👨‍🍳</div>
        <div class="font-display text-2xl font-bold italic">Delicious</div>
        <div class="text-[10px] text-white/70">Restaurant</div>
    </a>

    <nav class="flex-1 space-y-1 text-sm font-medium">
        @foreach($nav as [$route, $label, $icon, $pattern])
            <a href="{{ route($route) }}"
               class="{{ request()->routeIs($pattern) ? 't-on' : '' }} flex items-center gap-3 rounded-xl px-4 py-2.5 transition hover:bg-white/10">
                <span>{{ $icon }}</span>{{ $label }}
            </a>
        @endforeach
        <a href="{{ route('menu') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition hover:bg-white/10">
            <span>🌐</span>View Website
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">@csrf
        <button class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition hover:bg-white/10">
            <span>🚪</span>Logout
        </button>
    </form>
</aside>

<div class="lg:pl-60">
    <header class="t-card sticky top-0 z-40 flex items-center justify-between gap-3 border-x-0 border-t-0 px-4 py-3">
        <button type="button" class="t-soft flex h-9 w-9 items-center justify-center rounded-full lg:hidden"
                onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')" aria-label="Menu">☰</button>
        <div class="flex-1"></div>
        <x-theme-toggle />
        <div class="flex items-center gap-2 text-sm font-medium">
            <span class="t-soft flex h-8 w-8 items-center justify-center rounded-full">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
        </div>
    </header>

    <main class="p-4 sm:p-6">
        @if(session('success'))
            <div class="mb-4 rounded-xl bg-green-500/15 px-4 py-3 text-sm font-medium text-green-600">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>
