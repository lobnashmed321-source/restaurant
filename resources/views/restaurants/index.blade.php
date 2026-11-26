@extends('layouts.admin')

@section('title', 'Meals')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="font-display text-3xl font-bold">Meals Management</h1>
        <p class="t-mute text-sm">Manage your restaurant meals</p>
    </div>
    <a href="{{ route('restaurants.create') }}" class="t-btn">+ Add New Meal</a>
</div>

<form method="GET" class="mb-4 flex flex-col gap-3 sm:flex-row">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search meals..." class="t-input sm:flex-1">
    <select name="category" class="t-input sm:w-56">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    <button class="t-btn">Filter</button>
</form>

<div class="t-card overflow-x-auto rounded-2xl shadow-sm">
    <table class="w-full min-w-[560px] text-left text-sm">
        <thead class="t-mute">
            <tr><th class="p-4">Image</th><th>Name</th><th>Category</th><th>Price</th><th class="pr-4 text-right">Actions</th></tr>
        </thead>
        <tbody>
        @forelse($mens as $meal)
            <tr class="t-line border-t">
                <td class="p-3">
                    @if($meal->image)
                        <img src="{{ asset('storage/'.$meal->image) }}" alt="" class="h-12 w-12 rounded-xl object-cover">
                    @else
                        <div class="t-soft flex h-12 w-12 items-center justify-center rounded-xl text-xl">🍽️</div>
                    @endif
                </td>
                <td class="font-medium">{{ $meal->name }}</td>
                <td>{{ $meal->category }}</td>
                <td>{{ number_format($meal->price, 2) }}</td>
                <td class="pr-4">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('restaurants.edit', $meal) }}" class="t-soft rounded-lg px-3 py-1.5 text-xs font-semibold">Edit</a>
                        <form method="POST" action="{{ route('restaurants.destroy', $meal) }}"
                              onsubmit="return confirm('Delete this meal?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-lg bg-red-500/15 px-3 py-1.5 text-xs font-semibold text-red-500">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="t-mute p-8 text-center">No meals found. Add your first meal!</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $mens->links() }}</div>
@endsection
