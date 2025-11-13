<h2>Hello {{ $cart->user->name }},</h2>

<p>You left items in your cart! Here's what you added:</p>

<ul>
    @foreach ($cart->items as $item)
        <li>{{ $item->product->name }} — Quantity: {{ $item->quantity }}</li>
    @endforeach
</ul>

<p>
    <a href="{{ url('/cart') }}">Click here to return to your cart and complete your purchase</a>.
</p>

<p>This is reminder #{{ $reminderNumber }}.</p>

<p>Thanks,<br>Your Shop Team</p>
