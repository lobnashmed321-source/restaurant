@extends('layouts.site')

@section('title', 'Menu')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10">
    <h1 class="font-display mb-6 text-center text-4xl font-bold">Our Menu</h1>

    <form method="GET" action="{{ route('menu') }}" class="mb-6 flex flex-col gap-3 sm:flex-row">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search meals..." class="t-input sm:flex-1">
        <select name="category" class="t-input sm:w-56">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        <button class="t-btn">Filter</button>
    </form>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @forelse($mens as $meal)
            <x-meal-card :meal="$meal" />
        @empty
            <p class="t-mute col-span-full py-10 text-center">No meals found.</p>
        @endforelse
    </div>
</div>
@endsection