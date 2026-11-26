@props(['meal'])

<div class="t-card overflow-hidden rounded-2xl shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    @if($meal->image)
        <img src="{{ asset('storage/'.$meal->image) }}" alt="{{ $meal->name }}" class="h-44 w-full object-cover">
    @else
        <div class="t-soft flex h-44 items-center justify-center text-5xl">🍽️</div>
    @endif

    <div class="p-4">
        <h3 class="font-semibold">{{ $meal->name }}</h3>
        <p class="t-mute text-xs">{{ $meal->category }}</p>

        <div class="mt-4 flex items-center justify-between gap-2">
            <span class="t-accent text-lg font-bold">{{ number_format($meal->price, 2) }} EGP</span>

            @auth
                @unless(auth()->user()->isAdmin())
                    <form method="POST" action="{{ route('orders.store') }}" class="flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $meal->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="20" class="t-input !w-14 !px-1 text-center">
                        <button class="t-btn !px-3 !py-1.5 text-xs">Order</button>
                    </form>
                @endunless
            @else
                <a href="{{ route('login') }}" class="t-btn !px-3 !py-1.5 text-xs">Login to order</a>
            @endauth
        </div>
    </div>
</div>