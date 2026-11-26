@extends('layouts.admin')

@section('title', 'New Meal')

@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="font-display mb-6 text-3xl font-bold">Add New Meal</h1>

    <form method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data"
          class="t-card space-y-4 rounded-2xl p-6 shadow-sm">
        @csrf
        @include('restaurants._form')
        <button class="t-btn w-full">Save Meal</button>
    </form>
</div>
@endsection