<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Buat Pesanan Baru</h2>
    
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="block font-medium">Nama Pelanggan</label>
            <input type="text" name="customer_name" id="customer_name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="block font-medium">Nomor HP</label>
            <input type="text" name="phone_number" id="phone_number" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="block font-medium">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full p-2 border rounded" required>
        </div>
        
        

        <div class="mb-3">
            <label for="menu" class="block font-medium">Pilih Menu</label>
            <select name="menu[]" id="menu" class="w-full p-2 border rounded" multiple required>
                @foreach ($menus as $menu)
                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - Rp {{ number_format($menu->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div id="order-items" class="mb-3"></div>

        <!-- Menampilkan total harga -->
        <p class="text-lg font-semibold mt-4">Total Harga: <span id="total-price" class="text-green-600">Rp 0</span></p>

        <div class="mt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan Pesanan</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuSelect = document.getElementById("menu");
        const orderItemsContainer = document.getElementById("order-items");
        const totalPriceElement = document.getElementById("total-price");

        menuSelect.addEventListener("change", function() {
            orderItemsContainer.innerHTML = "";
            updateTotalPrice();

            Array.from(menuSelect.selectedOptions).forEach(option => {
                const menuId = option.value;
                const menuName = option.text;
                const menuPrice = parseFloat(option.getAttribute("data-price"));

                const itemDiv = document.createElement("div");
                itemDiv.classList.add("mb-3");

                itemDiv.innerHTML = `
                    <label class="block font-medium">${menuName} (Harga: Rp ${menuPrice.toLocaleString()})</label>
                    <input type="hidden" name="items[${menuId}][menu_id]" value="${menuId}">
                    <input type="number" name="items[${menuId}][quantity]" class="w-full p-2 border rounded quantity" data-price="${menuPrice}" value="1" min="1" required>
                `;

                orderItemsContainer.appendChild(itemDiv);
            });

            updateTotalPrice();
        });

        orderItemsContainer.addEventListener("input", function(event) {
            if (event.target.classList.contains("quantity")) {
                updateTotalPrice();
            }
        });

        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll(".quantity").forEach(input => {
                let price = parseFloat(input.getAttribute("data-price"));
                let quantity = parseInt(input.value);
                total += price * quantity;
            });
            totalPriceElement.textContent = "Rp " + total.toLocaleString();
        }
    });

    
</script>
