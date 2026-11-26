@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
    $stats = [
        ['🍽️', 'Total Meals', $totalMeals],
        ['🗂️', 'Total Categories', $totalCategories],
        ['🧾', 'Total Orders', $totalOrders],
        ['⏳', 'Pending Orders', $pendingOrders],
    ];
    $labels = ['pending' => 'Pending', 'preparing' => 'Preparing', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'];
    $colors = ['pending' => 'bg-yellow-500/15 text-yellow-600', 'preparing' => 'bg-blue-500/15 text-blue-500',
               'delivered' => 'bg-green-500/15 text-green-600', 'cancelled' => 'bg-red-500/15 text-red-500'];
@endphp

<h1 class="font-display text-3xl font-bold">Dashboard</h1>
<p class="t-mute mb-6 text-sm">Welcome back, {{ auth()->user()->name }}!</p>

<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach($stats as [$icon, $label, $value])
        <div class="t-card rounded-2xl p-5 shadow-sm">
            <div class="text-2xl">{{ $icon }}</div>
            <div class="t-mute mt-2 text-sm">{{ $label }}</div>
            <div class="mt-1 text-3xl font-bold">{{ $value }}</div>
        </div>
    @endforeach
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="t-card overflow-x-auto rounded-2xl p-5 shadow-sm lg:col-span-2">
        <h2 class="mb-3 font-semibold">Latest Orders</h2>
        <table class="w-full min-w-[480px] text-left text-sm">
            <thead class="t-mute">
                <tr><th class="py-2">#</th><th>Customer</th><th>Meal</th><th>Total</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse($latest as $o)
                <tr class="t-line border-t">
                    <td class="py-2.5">{{ $o->id }}</td>
                    <td>{{ $o->user->name }}</td>
                    <td>{{ $o->restaurant->name }}</td>
                    <td>{{ number_format($o->total, 2) }}</td>
                    <td><span class="{{ $colors[$o->status] }} rounded-full px-2.5 py-1 text-xs font-semibold">{{ $labels[$o->status] }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5" class="t-mute py-6 text-center">No orders yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="t-card flex flex-col items-center justify-center rounded-2xl p-6 text-center shadow-sm">
        <div class="text-5xl">👨‍🍳</div>
        <div class="font-display mt-2 text-xl font-bold">Delicious Restaurant</div>
        <p class="t-mute mt-1 text-sm">Manage your restaurant with ease.</p>
        <a href="{{ route('restaurants.index') }}" class="t-btn mt-4">Manage Meals →</a>
    </div>
</div>
@endsection
