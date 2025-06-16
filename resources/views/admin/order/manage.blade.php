<x-app-layout>
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="min-w-0 flex-1">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Kelola Pesanan Masuk
                        </h1>
                        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
                            Tinjau, proses, dan perbarui status pesanan dari pelanggan.
                        </p>
                    </div>
                </div>
                {{-- Statistik Ringkas --}}
                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Pesanan Pending</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-yellow-500">{{ $orders->where('status', 'Pending')->count() }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Sedang Diproses</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-blue-500">{{ $orders->where('status', 'Process')->count() }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Pesanan Aktif</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $orders->count() }}</dd>
                    </div>
                </div>
            </div>

            <!-- Filter dan Notifikasi -->
            <div class="mb-6">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md" role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </div>

            <!-- Daftar Pesanan dalam Bentuk Kartu -->
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                        <!-- Card Header -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <div class="sm:flex sm:justify-between sm:items-center">
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Pelanggan: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $order->user->name ?? '-' }}</span>
                                    </p>
                                </div>
                                <div class="mt-3 sm:mt-0 text-left sm:text-right">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex items-start gap-6">
                                <img src="{{ asset('storage/' . $order->product->image) }}" class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg" alt="{{ $order->product->name }}">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $order->product->name ?? '-' }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $order->quantity }} | Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <div class="mt-2 text-gray-700 dark:text-gray-300">
                                        <p class="font-semibold">Alamat Pengiriman:</p>
                                        <p>{{ $order->address }}</p>
                                        <p>Kontak: {{ $order->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Footer - Form Aksi -->
                        <div class="px-6 py-5 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                            {{-- Form Update - Route dan Method Tetap Sama --}}
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="md:flex md:items-end md:justify-between md:gap-4">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 sm:grid-cols-2 md:flex-1 md:gap-4">
                                    <!-- Status Update -->
                                    <div>
                                        <label for="status-{{ $order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubah Status</label>
                                        <select name="status" id="status-{{ $order->id }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Process" {{ $order->status === 'Process' ? 'selected' : '' }}>Process</option>
                                            <option value="Success" {{ $order->status === 'Success' ? 'selected' : '' }}>Success</option>
                                        </select>
                                    </div>
                                    <!-- Estimasi Selesai -->
                                    <div class="mt-4 sm:mt-0">
                                        @php
                                            $estimated = null;
                                            if ($order->estimated_completion) {
                                                $estimated = \Carbon\Carbon::parse($order->estimated_completion)->format('Y-m-d');
                                            } elseif ($order->status === 'Process') {
                                                $estimated = \Carbon\Carbon::now()->addDays(3)->format('Y-m-d');
                                            }
                                        @endphp
                                        <label for="estimated_completion-{{ $order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estimasi Selesai</label>
                                        <input type="date" name="estimated_completion" id="estimated_completion-{{ $order->id }}"
                                               value="{{ $estimated }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                
                                <button type="submit"
                                    class="w-full mt-4 md:w-auto md:mt-0 inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition-colors">
                                    Update Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white dark:bg-gray-800 rounded-2xl shadow-md p-12">
                        <svg class="mx-auto h-16 w-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Kerja bagus!</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tidak ada pesanan yang perlu diproses saat ini.</p>
                    </div>
                @endforelse
            </div>
            
            @if ($orders->hasPages())
                <div class="mt-10">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>