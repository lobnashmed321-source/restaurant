@extends(auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.site')

@section('title', 'Orders')

@section('content')
@php
    $isAdmin = auth()->user()->isAdmin();
    $labels = ['pending' => 'Pending', 'preparing' => 'Preparing', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'];
    $colors = ['pending' => 'bg-yellow-500/15 text-yellow-600', 'preparing' => 'bg-blue-500/15 text-blue-500',
               'delivered' => 'bg-green-500/15 text-green-600', 'cancelled' => 'bg-red-500/15 text-red-500'];
@endphp

<div class="{{ $isAdmin ? '' : 'mx-auto max-w-6xl px-4 py-10' }}">
    <h1 class="font-display mb-6 text-3xl font-bold">{{ $isAdmin ? 'All Orders' : 'My Orders' }}</h1>

    <div class="t-card overflow-x-auto rounded-2xl shadow-sm">
        <table class="w-full min-w-[600px] text-left text-sm">
            <thead class="t-mute">
                <tr>
                    <th class="p-4">#</th>
                    @if($isAdmin)<th>Customer</th>@endif
                    <th>Meal</th><th>Qty</th><th>Total</th><th>Status</th><th>Date</th>
                </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr class="t-line border-t">
                    <td class="p-4">{{ $order->id }}</td>
                    @if($isAdmin)<td>{{ $order->user->name }}</td>@endif
                    <td class="font-medium">{{ $order->restaurant->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td class="font-semibold">{{ number_format($order->total, 2) }}</td>
                    <td>
                        @if($isAdmin)
                            <form method="POST" action="{{ route('orders.status', $order) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="t-input !w-auto !py-1">
                                    @foreach($labels as $key => $label)
                                        <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <span class="{{ $colors[$order->status] }} rounded-full px-2.5 py-1 text-xs font-semibold">{{ $labels[$order->status] }}</span>
                        @endif
                    </td>
                    <td class="t-mute text-xs">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="t-mute p-8 text-center">No orders yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection