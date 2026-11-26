<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class HomeController extends Controller
{
    public function index()
    {
        $meals = Restaurant::latest()->take(4)->get();

        return view('home', compact('meals'));
    }

    public function menu()
    {
        $mens = Restaurant::query()
            ->when(request('category'), fn ($q, $c) => $q->where('category', $c))
            ->when(request('q'), fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->latest()
            ->get();

        $categories = Restaurant::select('category')->distinct()->pluck('category');

        return view('menu', compact('mens', 'categories'));
    }
}