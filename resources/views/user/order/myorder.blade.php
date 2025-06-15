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

                        <p><strong>Estimasi Selesai:</strong>
                            @if ($order->estimated_completion)
                                {{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M Y') }}
                            @else
                                <span class="text-gray-400 italic">Belum ada estimasi</span>
                            @endif
                        </p>

                        <p>
                            @if ($order->status === 'Pending')
                                <span class="text-yellow-500 font-semibold">⏳ Pending</span>
                            @elseif ($order->status === 'Process')
                                <span class="text-blue-500 font-semibold">🔄 Proses</span>
                            @elseif ($order->status === 'Success')
                                <span class="text-green-600 font-semibold">✅ Sukses</span>
                            @else
                                <span class="text-gray-500">Unknown</span>
                            @endif
                        </p>

                        <p class="text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d M Y H:i') }}</p>

                        <!-- Tombol Lihat Detail -->
                        <button onclick="openModal({{ $order->id }})" class="text-blue-600 hover:underline mt-2 mb-2">
                            Lihat Detail
                        </button>

                        <!-- Modal -->
                        <div id="modal-{{ $order->id }}"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                                <button onclick="closeModal({{ $order->id }})"
                                    class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">×</button>

                                <h2 class="text-xl font-bold mb-4">{{ $order->product->name }}</h2>
                                <img src="{{ asset('storage/' . $order->product->image) }}"
                                    class="w-full h-70 object-cover rounded mb-4" alt="Produk">
                                <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                                <p><strong>No HP:</strong> {{ $order->phone }}</p>
                                <p><strong>Alamat:</strong> {{ $order->address }}</p>
                                <p><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                                <p><strong>Estimasi Selesai:</strong>
                                    @if ($order->estimated_completion)
                                        {{ \Carbon\Carbon::parse($order->estimated_completion)->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400 italic">Belum ada estimasi</span>
                                    @endif
                                </p>

                                <p>
                                    <strong>Status:</strong>
                                    @if ($order->status === 'Pending')
                                        <span class="text-yellow-500 font-semibold">⏳ Pending</span>
                                    @elseif ($order->status === 'Process')
                                        <span class="text-blue-500 font-semibold">🔄 Proses</span>
                                    @elseif ($order->status === 'Success')
                                        <span class="text-green-600 font-semibold">✅ Sukses</span>
                                    @else
                                        <span class="text-gray-500">Unknown</span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 mt-2">Dipesan pada
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-gray-600">Kamu belum memesan apa-apa... Beli dulu lah~!</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Tambahin ini juga buat fungsi buka tutup modal -->
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>
</x-app-layout>