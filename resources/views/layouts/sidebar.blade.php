{{-- resources/views/layouts/partials/_admin-sidebar.blade.php (dengan Dropdown) --}}

<div class="w-64 fixed inset-0 z-40 bg-gray-800 text-white flex flex-col min-h-screen">
    <!-- Logo -->
    @if (Auth::user()->is_admin)
        <div class="h-16 flex items-center justify-center bg-gray-900">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Panel</a>
        </div>
    @else
        <div class="h-16 flex items-center justify-center bg-gray-900">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">User Panel</a>
        </div>
    @endif

    <nav class="flex-grow p-4 space-y-2">

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-2 rounded-md transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Belanja Produk -->
        <a href="{{ route('home.products') }}" class="flex items-center px-4 py-2 rounded-md transition duration-200 
        {{ request()->routeIs('home.products') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-8 5-8-5" />
            </svg>
            <span>Belanja Produk</span>
        </a>

        <!-- Pesanan Saya -->
        <a href="{{ route('orders.my') }}" class="flex items-center px-4 py-2 rounded-md transition duration-200 
        {{ request()->routeIs('orders.my') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2z" />
            </svg>
            <span>Pesanan Saya</span>
        </a>

        <a href="{{ route('orders.history') }}" class="flex items-center px-4 py-2 rounded-md transition duration-200 
        {{ request()->routeIs('orders.history') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Riwayat Pesanan</span>
        </a>

        @if (Auth::user()->is_admin)
            <!-- === KELOLA PRODUK (DROPDOWN MENU) === -->
            <div x-data="{ open: {{ request()->routeIs('admin.product.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-md transition duration-200 hover:bg-gray-700 focus:outline-none">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Kelola Produk</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-transition class="mt-2 ml-4 pl-4 border-l-2 border-gray-600 space-y-2">
                    <a href="{{ route('admin.product.index') }}"
                        class="block px-4 py-2 rounded-md text-sm transition duration-200
                                                              {{ request()->routeIs('admin.product.index') ? 'bg-gray-700' : 'hover:bg-gray-600' }}">
                        Lihat Data Produk
                    </a>

                    <a href="{{ route('admin.product.create') }}"
                        class="block px-4 py-2 rounded-md text-sm transition duration-200
                                                              {{ request()->routeIs('admin.product.create') ? 'bg-gray-700' : 'hover:bg-gray-600' }}">
                        Tambah Data Produk
                    </a>

                    @if (request()->routeIs('admin.product.edit'))
                        <a href="#" class="block px-4 py-2 rounded-md text-sm bg-gray-700">
                            Edit Data Produk
                        </a>
                    @endif
                </div>
            </div>

            <a href="{{ route('admin.orders.manage') }}"
                class="flex items-center px-4 py-2 rounded-md transition duration-200 
                   {{ request()->routeIs('admin.orders.manage') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2z" />
                </svg>
                <span>Kelola Pesanan</span>
            </a>


            <a href="{{ route('admin.orders.history') }}"
                class="flex items-center px-4 py-2 rounded-md transition duration-200 
                                           {{ request()->routeIs('admin.orders.history') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Riwayat Pemesanan</span>
            </a>
        @endif

    </nav>

    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-gray-700">
        <div class="text-sm">Masuk sebagai:</div>
        <div class="font-semibold">{{ Auth::user()->name }}</div>
    </div>
</div>