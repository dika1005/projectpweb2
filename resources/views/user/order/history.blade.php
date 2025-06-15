<x-app-layout>
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 pb-8 mb-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="min-w-0 flex-1">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Riwayat Pesanan
                        </h1>
                        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
                            Semua pesanan Anda yang telah selesai tercatat di sini.
                        </p>
                    </div>
                    <div class="mt-4 flex md:ml-4 md:mt-0 gap-2">
                        <a href="{{ route('orders.my') }}"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                            Kembali ke Pesanan Aktif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Daftar Riwayat Pesanan -->
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300">
                        <!-- Card Header -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <div class="sm:flex sm:justify-between sm:items-center">
                                <dl class="grid grid-cols-2 sm:grid-cols-3 gap-x-6 text-sm">
                                    <div>
                                        <dt class="font-medium text-gray-500 dark:text-gray-400">Nomor Pesanan</dt>
                                        <dd class="mt-1 font-semibold text-gray-900 dark:text-white">
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</dd>
                                    </div>
                                    <div class="hidden sm:block">
                                        <dt class="font-medium text-gray-500 dark:text-gray-400">Tanggal Pemesanan</dt>
                                        <dd class="mt-1 font-semibold text-gray-900 dark:text-white">
                                            {{ $order->created_at->format('d F Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-medium text-gray-500 dark:text-gray-400">Tanggal Selesai</dt>
                                        <dd class="mt-1 font-semibold text-gray-900 dark:text-white">
                                            {{ $order->updated_at->format('d F Y') }}</dd>
                                    </div>
                                </dl>
                                <!-- Tombol untuk memanggil fungsi invoice -->
                                <div class="mt-4 sm:mt-0">
    <button type="button"
        class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 show-invoice-btn"
        data-order='@json($order->load(["product", "user"]))'>
        Lihat Invoice
    </button>
</div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="w-20 h-20 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $order->product->image) }}"
                                        alt="{{ $order->product->name }}" class="h-full w-full object-cover rounded-lg">
                                </div>
                                <div class="ml-4 flex flex-1 flex-col">
                                    <div class="sm:flex sm:justify-between">
                                        <h4 class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $order->product->name }}</h4>
                                        <p class="mt-1 sm:mt-0 text-base font-bold text-gray-900 dark:text-white">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $order->quantity }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm font-medium text-green-600 dark:text-green-300">Pesanan Selesai</p>
                                </div>
                                <a href="{{ route('orders.create', $order->product->id) }}"
                                    class="font-medium text-sm rounded-md bg-white dark:bg-gray-700 px-4 py-2 text-indigo-600 dark:text-indigo-300 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Beli Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white dark:bg-gray-800 rounded-2xl shadow-md p-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Riwayat pesanan Anda masih
                            kosong.</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Semua pesanan yang telah selesai akan
                            tercatat di sini.</p>
                    </div>

            @if ($orders->hasPages())
                <div class="mt-10">
                    {{ $orders->links() }}
                </div>
            @endif
                @endforelse
            </div>

        </div>
    </div>
   @vite('resources/js/invoice.js')



</x-app-layout>