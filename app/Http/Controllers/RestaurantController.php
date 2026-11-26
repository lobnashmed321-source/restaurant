<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        $mens = Restaurant::query()
            ->when(request('q'), fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when(request('category'), fn ($q, $c) => $q->where('category', $c))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $categories = Restaurant::select('category')->distinct()->pluck('category');

        return view('restaurants.index', compact('mens', 'categories'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'image'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('restaurants', 'public');
        }

        Restaurant::create($validated);

        return redirect()->route('restaurants.index')
            ->with('success', 'Meal created successfully');
    }

    public function show(Restaurant $restaurant)
    {
        return redirect()->route('restaurants.edit', $restaurant);
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'image'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }

            $validated['image'] = $request->file('image')->store('restaurants', 'public');
        }

        $restaurant->update($validated);

        return redirect()->route('restaurants.index')
            ->with('success', 'Meal updated successfully');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->image) {
            Storage::disk('public')->delete($restaurant->image);
        }

        $restaurant->delete();

        return redirect()->route('restaurants.index')
            ->with('success', 'Meal deleted successfully');
    }
}