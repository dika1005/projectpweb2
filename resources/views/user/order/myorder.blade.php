<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse ($orders as $order)
                    <div class="border-b pb-4 mb-4">
                        <h3 class="text-lg font-bold mb-1">{{ $order->product->name }}</h3>
                        <img src="{{ asset('storage/' . $order->product->image) }}" class="w-32 h-32 object-cover mb-2"
                            alt="Gambar Produk">
                        <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                        <p><strong>No HP:</strong> {{ $order->phone }}</p>
                        <p><strong>Alamat:</strong> {{ $order->address }}</p>
                        <p><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Kamu belum memesan apa-apa... Beli dulu lah~!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>