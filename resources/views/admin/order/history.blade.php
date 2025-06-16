<x-app-layout>
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="min-w-0 flex-1">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Arsip Pesanan Selesai
                        </h1>
                        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
                            Semua riwayat pesanan yang telah berhasil diselesaikan oleh pelanggan.
                        </p>
                    </div>
                    {{-- Placeholder untuk fitur pencarian --}}
                    <div class="mt-4 flex md:ml-4 md:mt-0">
                       <form method="GET" action="{{ route('admin.orders.history') }}" class="flex items-center gap-2">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}"
        placeholder="Cari pesanan..." 
        class="w-full md:w-auto rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
    <button 
        type="submit"
        class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition"
    >
        Cari
    </button>
</form>

                    </div>
                </div>
            </div>
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Detail Produk</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Info Pelanggan</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    {{-- Kolom Detail Produk --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-14 w-14">
                                                <img class="h-14 w-14 rounded-md object-cover" src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name ?? '' }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $order->product->name ?? '-' }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $order->quantity }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    {{-- Kolom Info Pelanggan --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <div class="font-medium">{{ $order->user->name ?? '-' }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">{{ $order->address }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">{{ $order->phone }}</div>
                                    </td>

                                    {{-- Kolom Total --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    
                                    {{-- Kolom Tanggal & Waktu --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold leading-5 rounded-full 
                                            @if($order->status == 'Success') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-16 px-6">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada riwayat pesanan.</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pesanan yang telah selesai akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($orders->hasPages())
                    <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>