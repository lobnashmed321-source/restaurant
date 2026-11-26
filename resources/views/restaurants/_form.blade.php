@php $meal = $meal ?? null; @endphp

<div>
    <label class="mb-1 block text-sm font-medium">Meal name</label>
    <input type="text" name="name" value="{{ old('name', $meal->name ?? '') }}" class="t-input">
    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>

<div>
    <label class="mb-1 block text-sm font-medium">Category</label>
    <input type="text" name="category" value="{{ old('category', $meal->category ?? '') }}" class="t-input"
           placeholder="Pizza, Burgers, Pasta...">
    @error('category') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>

<div>
    <label class="mb-1 block text-sm font-medium">Price (EGP)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $meal->price ?? '') }}" class="t-input">
    @error('price') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>

<div>
    <label class="mb-1 block text-sm font-medium">Image</label>
    @if($meal && $meal->image)
        <img src="{{ asset('storage/'.$meal->image) }}" alt="" class="mb-2 h-24 w-24 rounded-xl object-cover">
    @endif
    <input type="file" name="image" class="t-mute block w-full text-sm">
    @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>