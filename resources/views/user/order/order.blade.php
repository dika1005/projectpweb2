<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pemesanan Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/2">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-64 object-cover rounded-lg">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-700 mt-2">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-gray-700">Ukuran: {{ $product->size }}</p>
                    <p class="text-gray-700">Stok Tersedia: {{ $product->stock }} pcs</p>
                    <p class="text-sm text-gray-600 mt-3">{{ $product->description }}</p>
                </div>
            </div>

            <form action="{{ route('orders.store', $product->id) }}" method="POST" class="order-form mt-6 space-y-4"
                data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="phone"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="address" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Dibeli</label>
                    <div class="flex items-center space-x-2 mt-1">
                        <button type="button" class="decreaseQty px-3 py-1 bg-gray-300 rounded">−</button>
                        <span class="quantityDisplay text-lg font-medium">1</span>
                        <button type="button" class="increaseQty px-3 py-1 bg-gray-300 rounded">+</button>
                    </div>
                    <input type="hidden" name="quantity" class="quantity" value="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="text"
                        class="total_price_display mt-1 block w-full border border-gray-300 bg-gray-100 rounded-md shadow-sm sm:text-sm text-gray-800"
                        disabled>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        🛒 Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    @vite('resources/js/order.js')
</x-app-layout>