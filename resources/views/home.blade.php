@extends('layouts.site')

@section('title', 'Home')

@section('content')

<section class="mx-auto grid max-w-6xl items-center gap-8 px-4 py-12 md:grid-cols-2">
    <div>
        <p class="t-accent mb-3 text-xs font-semibold tracking-widest">— WELCOME TO DELICIOUS —</p>
        <h1 class="font-display text-5xl font-bold leading-tight lg:text-6xl">Good Food.<br>Great Moments.</h1>
        <p class="t-mute mt-4 max-w-sm">Enjoy the best meals, made with love and fresh ingredients.</p>
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('menu') }}" class="t-btn">Explore Menu →</a>
            <a href="#about" class="t-ghost">Our Story</a>
        </div>
    </div>
    <div class="t-soft overflow-hidden rounded-[2rem] shadow-lg">
        <img src="{{ asset('images/hero.jpg') }}" alt="Delicious food" class="h-72 w-full object-cover md:h-96"
             onerror="this.replaceWith(Object.assign(document.createElement('div'),{className:'flex h-72 items-center justify-center text-8xl md:h-96',textContent:'🍝'}))">
    </div>
</section>

@php
    $cats = [['🍽️','Main Courses'],['🍔','Burgers'],['🍕','Pizza'],['🍝','Pasta'],['🍰','Desserts'],['🥤','Drinks']];
@endphp
<section id="categories" class="mx-auto max-w-6xl scroll-mt-24 px-4 py-8">
    <h2 class="font-display mb-6 text-center text-3xl font-bold">Our Categories</h2>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @foreach($cats as [$icon, $name])
            <a href="{{ route('menu', ['category' => $name]) }}"
               class="t-card rounded-2xl p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="t-soft mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-full text-2xl">{{ $icon }}</div>
                <div class="text-sm font-semibold">{{ $name }}</div>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-8">
    <div class="mb-6 text-center">
        <h2 class="font-display text-3xl font-bold">Popular Meals</h2>
        <p class="t-mute text-sm">Delicious food, just for you</p>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @forelse($meals as $meal)
            <x-meal-card :meal="$meal" />
        @empty
            <p class="t-mute col-span-full text-center">No meals yet.</p>
        @endforelse
    </div>
</section>

<section id="about" class="mx-auto max-w-6xl scroll-mt-24 px-4 py-8">
    <div class="t-card grid items-center gap-8 rounded-3xl p-6 shadow-sm lg:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-bold">About Our Restaurant</h2>
            <p class="t-mute mt-3 text-sm leading-relaxed">We are more than just a restaurant. We are a place where good food, great company, and happiness come together.</p>
            <a href="{{ route('menu') }}" class="t-btn mt-5">Learn More →</a>
        </div>
        <div class="grid grid-cols-2 gap-4 text-center text-sm font-medium sm:grid-cols-4">
            <div><div class="t-soft mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-full text-xl">🌿</div>Fresh Ingredients</div>
            <div><div class="t-soft mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-full text-xl">👨‍🍳</div>Professional Chefs</div>
            <div><div class="t-soft mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-full text-xl">💎</div>Quality Food</div>
            <div><div class="t-soft mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-full text-xl">⚡</div>Fast Service</div>
        </div>
    </div>
</section>

<section id="contact" class="mx-auto max-w-6xl scroll-mt-24 px-4 py-8">
    <div class="t-side grid gap-6 rounded-3xl p-6 lg:grid-cols-3">
        <div>
            <h2 class="font-display text-2xl font-bold">Get In Touch</h2>
            <p class="mt-1 text-sm text-white/70">We'd love to hear from you!</p>
            <ul class="mt-4 space-y-1 text-sm text-white/80">
                <li>📍 New Valley, Egypt</li>
                <li>📞 +20 123 456 789</li>
                <li>✉️ info@delicious.com</li>
                <li>🕘 Mon - Sun: 9AM - 11PM</li>
            </ul>
        </div>
        <div class="space-y-3 lg:col-span-2">
            <div class="grid gap-3 sm:grid-cols-2">
                <input class="t-input" placeholder="Your Name">
                <input class="t-input" placeholder="Your Email">
            </div>
            <textarea class="t-input" rows="3" placeholder="Your Message"></textarea>
            <button type="button" class="t-btn !bg-white/20 hover:!bg-white/30">Send Message →</button>
        </div>
    </div>
</section>

@endsection
