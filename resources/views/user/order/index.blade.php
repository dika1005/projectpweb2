@php
    $orderRoutePrefix = route('orders.create', ['product' => '__ID__']);
@endphp

<x-app-layout>
    {{-- Kita hapus header default untuk kontrol penuh atas layout --}}
    {{-- <x-slot name="header">...</x-slot> --}}

    <div class="bg-gray-50 dark:bg-gray-900" x-data="{ selectedProduct: null }">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">Koleksi Sepatu
                    Kami</h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400">Temukan pasangan sempurna
                    untuk setiap langkah Anda.</p>
            </div>

            <!-- Search Section -->
            <div class="mb-8">
                {{-- FORM PENCARIAN PRODUK - JALURNYA TETAP SAMA --}}
                <form action="{{ route('home.products') }}" method="GET" class="max-w-lg mx-auto">
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari sepatu impianmu..."
                            value="{{ request('search') }}"
                            class="block w-full rounded-full border-0 bg-white dark:bg-gray-800 py-3 pl-10 pr-4 text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md"
                    role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
                @forelse ($products as $product)
                    <div
                        class="group relative flex flex-col overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            {{-- Fungsionalitas @click dipindahkan ke overlay untuk kejelasan --}}
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            {{-- Quick View Overlay - @click tetap sama --}}
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer"
                                @click="selectedProduct = {{ $product->toJson() }}">
                                <button
                                    class="text-white bg-black/50 backdrop-blur-sm py-2 px-4 rounded-lg font-semibold">Lihat
                                    Cepat</button>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col space-y-2 p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{-- Link dibuat tidak fungsional, event @click yang utama --}}
                                <a href="#" @click.prevent="selectedProduct = {{ $product->toJson() }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <div class="flex flex-1 flex-col justify-end">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ukuran: {{ $product->size }} | Stok:
                                    {{ $product->stock }}
                                </p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <div class="flex items-center gap-2 mt-4">
                                    {{-- Tombol Pesan - LINKNYA TETAP SAMA --}}
                                    <a href="{{ route('orders.create', $product->id) }}"
                                        class="z-10 relative flex-1 text-center bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-semibold flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4 text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Oops! Produk tidak ditemukan.
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain atau lihat semua
                            koleksi kami.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{-- Pagination Links - JALURNYA TETAP SAMA --}}
                {{ $products->withQueryString()->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Modal Detail Produk -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-show="selectedProduct"
            style="display: none;" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Modal Backdrop -->
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="selectedProduct = null"></div>

            <!-- Modal Content -->
            <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl"
                @click.away="selectedProduct = null" x-show="selectedProduct" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <template x-if="selectedProduct">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- Product Image -->
                        <div class="aspect-w-3 aspect-h-4">
                            {{-- Data Alpine.js Tetap Sama --}}
                            <img :src="'/storage/' + selectedProduct.image" :alt="selectedProduct.name"
                                class="w-full h-full object-cover md:rounded-l-2xl" x-show="selectedProduct.image">
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center md:rounded-l-2xl"
                                x-show="!selectedProduct.image">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="p-6 md:p-8 flex flex-col">
                            <button @click="selectedProduct = null"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors z-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white" x-text="selectedProduct.name">
                            </h2>

                            <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                Rp <span x-text="Number(selectedProduct.price).toLocaleString('id-ID')"></span>
                            </p>

                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Deskripsi</h3>
                                <div class="mt-2 space-y-4 text-base text-gray-700 dark:text-gray-300"
                                    x-text="selectedProduct.description"></div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="font-medium text-gray-600 dark:text-gray-400">Ukuran</p>
                                    <p class="font-bold text-gray-900 dark:text-white" x-text="selectedProduct.size">
                                    </p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-600 dark:text-gray-400">Stok Tersedia</p>
                                    <p class="font-bold text-gray-900 dark:text-white"
                                        x-text="selectedProduct.stock + ' pcs'"></p>
                                </div>
                            </div>

                            <div class="mt-auto pt-6">
                                {{-- Tombol di modal - LINKNYA DIBUAT DINAMIS TAPI TUJUANNYA SAMA --}}
                                <a :href="'{{ $orderRoutePrefix }}'.replace('__ID__', selectedProduct.id)"
                                    class="w-full bg-indigo-600 text-white py-3 px-8 rounded-lg hover:bg-indigo-700 transition-colors text-base font-semibold flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                    Pesan Sekarang
                                </a>


                            </div>
                        </div>
                    </div>
                </template>
        
            </div>
        </div>
    </div>
</x-app-layout>