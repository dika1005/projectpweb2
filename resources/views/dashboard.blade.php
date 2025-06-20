<x-app-layout>
    {{-- Kita bisa menghapus header default untuk layout yang lebih bebas --}}
    {{-- <x-slot name="header">...</x-slot> --}}

    <div class="relative min-h-screen font-sans">
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop"
                alt="Stylish shoes collection" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="relative z-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">

                <!-- Welcome Header (menyatu dengan background) -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white tracking-tight">
                        Selamat Datang Kembali, {{ Auth::user()->name }}!
                    </h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-300">
                        Ini adalah pusat kendali Anda. Apa yang ingin Anda lakukan hari ini?
                    </p>
                </div>

                <!-- Admin Panel (Hanya terlihat oleh admin) -->
                @if (Auth::user()->is_admin)
                    <div
                        class="bg-indigo-600/80 backdrop-blur-lg rounded-2xl p-6 mb-8 shadow-xl text-white border border-white/10">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="bg-white/20 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold">Panel Admin Aktif</h4>
                                    <p class="mt-1 text-indigo-200">Anda memiliki akses ke fitur administratif.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                <!-- Action Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1: Profil -->
                    <a href="{{ route('profile.edit') }}"
                        class="block group bg-white/10 dark:bg-gray-800/50 backdrop-blur-xl p-8 rounded-2xl shadow-lg hover:shadow-indigo-500/20 hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-500/20 mb-6 group-hover:bg-indigo-500/40 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Profil Saya</h3>
                        <p class="mt-2 text-gray-300">Perbarui detail personal, email, dan kata sandi Anda.</p>
                        <div class="mt-6 font-semibold text-indigo-300 group-hover:text-white transition-colors">
                            Kelola Akun →
                        </div>
                    </a>

                    <!-- Card 2: Riwayat Pesanan -->
                    <a href=" {{ route('orders.history') }}"
                        class="block group bg-white/10 dark:bg-gray-800/50 backdrop-blur-xl p-8 rounded-2xl shadow-lg hover:shadow-green-500/20 hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-green-500/20 mb-6 group-hover:bg-green-500/40 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Riwayat Pesanan</h3>
                        <p class="mt-2 text-gray-300">Lacak status, lihat detail, dan kelola pesanan Anda.</p>
                        <div class="mt-6 font-semibold text-green-300 group-hover:text-white transition-colors">
                            Lihat Pesanan →
                        </div>
                    </a>

                    <!-- Card 3: Bantuan -->
                    <a href="https://wa.me/6281229266853?text=Halo%20admin%2C%20saya%20butuh%20bantuan%20nih"
                        target="_blank" rel="noopener noreferrer"
                        class="block group bg-white/10 dark:bg-gray-800/50 backdrop-blur-xl p-8 rounded-2xl shadow-lg hover:shadow-green-500/20 hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-green-500/20 mb-6 group-hover:bg-green-500/40 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Butuh Bantuan?</h3>
                        <p class="mt-2 text-gray-300">Langsung hubungi admin kami via WhatsApp.</p>
                        <div class="mt-6 font-semibold text-green-300 group-hover:text-white transition-colors">
                            Chat Sekarang →
                        </div>
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>