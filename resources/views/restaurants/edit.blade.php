@extends('layouts.admin')

@section('title', 'Edit Meal')

@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="font-display mb-6 text-3xl font-bold">Edit Meal</h1>

    <form method="POST" action="{{ route('restaurants.update', $restaurant) }}" enctype="multipart/form-data"
          class="t-card space-y-4 rounded-2xl p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('restaurants._form', ['meal' => $restaurant])
        <button class="t-btn w-full">Update Meal</button>
    </form>
</div>
@endsection
