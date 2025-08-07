
<div class="container">
    <h2>Detail Order #{{ $order->id }}</h2>
    <p><strong>Nama Pelanggan:</strong> {{ $order->customer_name }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $order->phone_number }}</p>
    <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Status Pengiriman:</strong> {{ $order->delivery_status }}</p>
    <p><strong>Tanggal Order:</strong> {{ $order->order_date }}</p>

    <h4>Item Pesanan:</h4>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->menu->name }} - {{ $item->quantity }}x</li>
        @endforeach
    </ul>

    <a href="{{ route('orders.history') }}" class="btn btn-primary">Kembali</a>
</div>
