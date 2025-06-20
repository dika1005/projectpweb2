<x-app-layout>
    {{-- Kita ganti header default dengan header custom yang lebih menarik --}}
    {{-- <x-slot name="header">...</x-slot> --}}

    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen" x-data="{ selectedOrder: null }">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="min-w-0 flex-1">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Pesanan Saya
                    </h1>
                    <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
                        Lacak dan kelola semua pesanan aktif Anda di sini.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a href="{{ route('orders.history') }}"
                        class="inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                        Lihat Riwayat Selesai
                    </a>
                </div>
            </div>

            <!-- Orders List -->
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                        <!-- Card Header -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <div class="sm:flex sm:justify-between sm:items-center">
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Dipesan pada: {{ $order->created_at->format('d F Y') }}
                                    </p>
                                </div>
                                <div class="mt-3 sm:mt-0 text-right">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Harga</p>
                                    <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex items-start gap-6">
                                <img src="{{ asset('storage/' . $order->product->image) }}"
                                    class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg"
                                    alt="{{ $order->product->name }}">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $order->product->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $order->quantity }}</p>
                                    <p class="mt-2 text-gray-700 dark:text-gray-300">
                                        Dikirim ke: <span class="font-semibold">{{ $order->address }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer - Status Tracker -->
                        <div class="px-6 py-5 bg-gray-50 dark:bg-gray-700/50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <!-- Progress Bar -->
                                <div class="flex items-center space-x-2 sm:space-x-4">
                                    @php
                                        $statuses = ['Pending', 'Process', 'Success'];
                                        $currentStatusIndex = array_search($order->status, $statuses);
                                    @endphp
                                    @foreach ($statuses as $index => $status)
                                        <div class="flex items-center {{ $index > 0 ? 'flex-1' : '' }}">
                                            @if ($index > 0)
                                                <div
                                                    class="w-full h-1 {{ $index <= $currentStatusIndex ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600' }}">
                                                </div>
                                            @endif
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ $index <= $currentStatusIndex ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600' }}">
                                                    @if ($index <= $currentStatusIndex)
                                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <p
                                                    class="text-xs mt-1 text-center {{ $index <= $currentStatusIndex ? 'text-indigo-600 dark:text-indigo-300 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
                                                    {{ $status === 'Pending' ? 'Dipesan' : ($status === 'Process' ? 'Diproses' : 'Selesai') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button @click="selectedOrder = {{ $order->load('product')->toJson() }}"
                                    class="w-full sm:w-auto shrink-0 bg-indigo-600 text-white py-2 px-5 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-semibold">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white dark:bg-gray-800 rounded-2xl shadow-md p-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Anda belum memiliki pesanan
                            aktif.</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Semua pesanan yang sedang diproses akan
                            muncul di sini.</p>
                        <div class="mt-6">
                            <a href="{{ route('home.products') }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                                Mulai Belanja Sekarang
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Detail Pesanan -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-show="selectedOrder"
            style="display: none;" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="selectedOrder = null"></div>
            <!-- Modal Content -->
            <div class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden"
                @click.away="selectedOrder = null" x-show="selectedOrder" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <template x-if="selectedOrder">
                    <div>
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white"
                                        x-text="selectedOrder.product.name"></h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"
                                        x-text="'Pesanan #' + String(selectedOrder.id).padStart(6, '0')"></p>
                                </div>
                                <button @click="selectedOrder = null"
                                    class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">×</button>
                            </div>
                        </div>

                        <div class="p-6 border-t border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-4">
                                <img :src="'/storage/' + selectedOrder.product.image"
                                    class="w-20 h-20 object-cover rounded-lg" :alt="selectedOrder.product.name">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 dark:text-gray-200"
                                        x-text="selectedOrder.product.name"></p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400"
                                        x-text="'Jumlah: ' + selectedOrder.quantity"></p>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                                        x-text="'Rp ' + Number(selectedOrder.product.price).toLocaleString('id-ID')">
                                    </p>
                                </div>
                                <p class="text-lg font-bold text-gray-900 dark:text-white"
                                    x-text="'Rp ' + Number(selectedOrder.total_price).toLocaleString('id-ID')"></p>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Pesanan</h4>
                                <p class="font-semibold text-lg"
                                    :class="{ 'text-green-600 dark:text-green-400': selectedOrder.status === 'Success', 'text-blue-600 dark:text-blue-400': selectedOrder.status === 'Process', 'text-yellow-600 dark:text-yellow-400': selectedOrder.status === 'Pending' }"
                                    x-text="selectedOrder.status"></p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat Pengiriman</h4>
                                <p class="text-gray-800 dark:text-gray-200" x-text="selectedOrder.address"></p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estimasi Selesai</h4>
                                <p class="text-gray-800 dark:text-gray-200"
                                    x-text="selectedOrder.estimated_completion ? new Date(selectedOrder.estimated_completion).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : 'Belum ada estimasi'">
                                </p>
                            </div>
                        </div>

                        <div class="p-6 bg-gray-50 dark:bg-gray-700/50">
                            <button @click="selectedOrder = null"
                                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition">Tutup</button>
                        </div>
                    </div>
                </template>
                @if ($orders->hasPages())
                    <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>