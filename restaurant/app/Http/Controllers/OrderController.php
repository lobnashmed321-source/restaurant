<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = $user->isAdmin()
            ? Order::with(['user', 'restaurant'])->latest()->get()
            : $user->orders()->with('restaurant')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'quantity'      => 'required|integer|min:1|max:20',
        ]);

        $meal = Restaurant::findOrFail($data['restaurant_id']);

        Order::create([
            'user_id'       => auth()->id(),
            'restaurant_id' => $meal->id,
            'quantity'      => $data['quantity'],
            'total'         => $meal->price * $data['quantity'],
        ]);

        return redirect()->route('orders.index')->with('success', 'Your order has been placed.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,preparing,delivered,cancelled',
        ]);

        $order->update($data);

        return back()->with('success', 'Order status updated.');
    }
}