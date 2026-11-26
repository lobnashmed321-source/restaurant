<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalMeals'      => Restaurant::count(),
            'totalCategories' => Restaurant::distinct('category')->count('category'),
            'totalOrders'     => Order::count(),
            'pendingOrders'   => Order::where('status', 'pending')->count(),
            'latest'          => Order::with(['user', 'restaurant'])->latest()->take(5)->get(),
        ]);
    }
}//

