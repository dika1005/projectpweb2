<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Sepatu MassDik - Step Into Style</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    aspectRatio: {
                        '4/5': '4 / 5',
                    },
                },
            },
        }
    </script>

    <!-- Styles for Dark Mode -->
    <style>
        /* Simple script to toggle dark mode */
        .dark {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39 / var(--tw-bg-opacity));
            /* bg-gray-900 */
            color: rgb(243 244 246 / 1);
            /* text-gray-100 */
        }

        .dark .dark\:bg-gray-800 {
            background-color: rgb(31 41 55 / 1);
        }

        .dark .dark\:bg-gray-950 {
            background-color: rgb(3 7 18 / 1);
        }

        .dark .dark\:text-white {
            color: #fff;
        }

        .dark .dark\:text-gray-300 {
            color: rgb(209 213 219 / 1);
        }

        .dark .dark\:text-gray-400 {
            color: rgb(156 163 175 / 1);
        }

        .dark .dark\:border-gray-700 {
            border-color: rgb(55 65 81 / 1);
        }

        .dark .dark\:hover\:bg-gray-700:hover {
            background-color: rgb(55 65 81 / 1);
        }

        .dark .dark\:hover\:text-white:hover {
            color: #fff;
        }
    </style>

</head>

<body class="h-full bg-white dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-900">
        <!-- Header -->
        <header class="relative bg-white dark:bg-gray-900">
            <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="flex h-16 items-center justify-between">
                        <!-- Logo -->
                        <div class="flex">
                            <a href="/">
                                <span class="sr-only">Toko Sepatu MassDik</span>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Toko Sepatu MassDik</h1>
                            </a>
                        </div>

                        <!-- Navigasi Kategori telah dihapus sesuai permintaan -->

                        <div class="flex items-center">
                            <!-- Auth links -->
                            @if (Route::has('login'))
                                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                            class="text-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="text-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Log
                                            in</a>
                                        <span class="h-6 w-px bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="text-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif

                            <!-- Search -->
                            <div class="flex lg:ml-6">
                                <a href="#"
                                    class="p-2 text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-300">
                                    <span class="sr-only">Search</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </a>
                            </div>

                            <!-- Cart -->
                            <div class="ml-4 flow-root lg:ml-6">
                                <a href="@guest{{ route('login') }}@else{{ url('/cart') }}@endguest"
                                    class="group -m-2 flex items-center p-2">
                                    <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-300"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    <span
                                        class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800 dark:text-gray-300 dark:group-hover:text-white">0</span>
                                    <span class="sr-only">items in cart, view bag</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero section -->
            <div class="relative">
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100 dark:bg-gray-800"></div>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative shadow-xl sm:overflow-hidden sm:rounded-2xl">
                        <div class="absolute inset-0">
                            <img class="h-full w-full object-cover" src="{{ asset('image/sepatuhh.avif') }}"
                                alt="Sepatu-sepatu keren">
                            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/75 to-gray-900/25"></div>
                        </div>
                        <div class="relative px-6 py-32 sm:px-12 sm:py-40 lg:px-16">
                            <h1 class="text-center text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">
                                <span class="block text-white">Step Into Style</span>
                                <span class="block text-indigo-200">Koleksi Terbaru Kami</span>
                            </h1>
                            <p class="mx-auto mt-6 max-w-lg text-center text-xl text-indigo-100 sm:max-w-3xl">Temukan
                                pasangan sempurna yang memadukan kenyamanan, kualitas, dan tren terkini. Jelajahi
                                sekarang.</p>
                            <div class="mx-auto mt-10 max-w-sm sm:flex sm:max-w-none sm:justify-center">
                                <a href="@auth{{ url('/shop') }}@else{{ route('login') }}@endauth"
                                    class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 sm:px-8">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <!-- Featured products section -->
            <section aria-labelledby="trending-heading" class="bg-white dark:bg-gray-900">
                <div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8 lg:py-32">
                    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                        <h2 id="trending-heading"
                            class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Produk Unggulan</h2>

                    </div>

                    <div class="relative mt-8">
                        <div class="relative w-full overflow-x-auto">
                            <ul role="list"
                                class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0">
                                <!-- Product 1 -->
                                <li class="inline-flex w-64 flex-col text-center lg:w-auto">
                                    <div class="group relative">
                                        <div
                                            class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                            <img src="{{ asset('image/sepatu1.jpg') }}" alt="all star shoe"
                                                class="h-full w-full object-cover object-center group-hover:opacity-75">

                                        </div>
                                        <div class="mt-6">
                                            <h3 class="mt-1 font-semibold text-gray-900 dark:text-white">
                                                <a href="{{ route('login', ['redirect' => route('home.products')]) }}">
                                                    <span class="absolute inset-0"></span>
                                                    Converse All Star
                                                </a>

                                            </h3>

                                        </div>
                                    </div>
                                </li>
                                <!-- Product 2 -->
                                <li class="inline-flex w-64 flex-col text-center lg:w-auto">
                                    <div class="group relative">
                                        <div
                                            class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                            <img src="{{ asset('image/sepatu2.jpeg') }}" alt="Colorful casual sneaker"
                                                class="h-full w-full object-cover object-center group-hover:opacity-75">

                                        </div>
                                        <div class="mt-6">
                                            <h3 class="mt-1 font-semibold text-gray-900 dark:text-white">
                                                <a href="{{ route('login', ['redirect' => route('home.products')]) }}">
                                                    <span class="absolute inset-0"></span>
                                                    ColorSplash Vibe
                                                </a>
                                            </h3>

                                        </div>
                                    </div>
                                </li>
                                <!-- Product 3 -->
                                <li class="inline-flex w-64 flex-col text-center lg:w-auto">
                                    <div class="group relative">
                                        <div
                                            class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                            <img src="{{ asset('image/sepatu3.jpeg') }}" alt="Brown leather boots"
                                                class="h-full w-full object-cover object-center group-hover:opacity-75">

                                        </div>
                                        <div class="mt-6">
                                            <h3 class="mt-1 font-semibold text-gray-900 dark:text-white">
                                                <a href="{{ route('login', ['redirect' => route('home.products')]) }}">
                                                    <span class="absolute inset-0"></span>
                                                    Urban Explorer
                                                </a>
                                            </h3>

                                        </div>
                                    </div>
                                </li>
                                <!-- Product 4 -->
                                <li class="inline-flex w-64 flex-col text-center lg:w-auto">
                                    <div class="group relative">
                                        <div
                                            class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                            <img src="{{ asset('image/sepatu4.jpeg') }}" alt="Classic checkerboard shoe"
                                                class="h-full w-full object-cover object-center group-hover:opacity-75">

                                        </div>
                                        <div class="mt-6">
                                            <h3 class="mt-1 font-semibold text-gray-900 dark:text-white">
                                                <a href="{{ route('login', ['redirect' => route('home.products')]) }}">
                                                    <span class="absolute inset-0"></span>
                                                    Classic Check
                                                </a>
                                            </h3>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-gray-100 dark:bg-gray-800 py-16 sm:py-24 rounded-2xl">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Apa Kata
                            Mereka?</h2>
                        <p class="mt-4 text-lg leading-6 text-gray-600 dark:text-gray-400">
                            Testimoni pelanggan kami yang puas dengan kualitas dan pelayanan.
                        </p>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
                        <!-- Testimoni 1 -->
                        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                            <p class="text-gray-700 dark:text-gray-300">“Sepatunya nyaman banget dipakai seharian. Suka
                                banget sama desainnya!”</p>
                            <div class="mt-4 text-sm font-medium text-gray-900 dark:text-white">- Sinta, Jakarta</div>
                        </div>

                        <!-- Testimoni 2 -->
                        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                            <p class="text-gray-700 dark:text-gray-300">“Pelayanannya cepat dan ramah. Barang sampai
                                dengan selamat!”</p>
                            <div class="mt-4 text-sm font-medium text-gray-900 dark:text-white">- Andi, Bandung</div>
                        </div>

                        <!-- Testimoni 3 -->
                        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                            <p class="text-gray-700 dark:text-gray-300">“Pilihan produknya banyak dan berkualitas
                                tinggi. Recommended banget!”</p>
                            <div class="mt-4 text-sm font-medium text-gray-900 dark:text-white">- Maya, Surabaya</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="bg-gray-300 dark:bg-gray-800 py-16 sm:py-24 rounded-2xl">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center">Pertanyaan Umum</h2>
                    <div class="mt-10 space-y-6">
                        <details class="group bg-white dark:bg-gray-900 p-4 rounded-md shadow-sm">
                            <summary
                                class="flex justify-between items-center font-medium cursor-pointer text-gray-700 dark:text-white">
                                Apakah saya bisa menukar produk jika ukurannya tidak pas?
                                <span class="ml-4 group-open:rotate-180 transition-transform">⌄</span>
                            </summary>
                            <p class="mt-4 text-gray-600 dark:text-gray-300">Tentu! Kami menerima penukaran barang dalam
                                waktu 7 hari setelah barang diterima.</p>
                        </details>

                        <details class="group bg-white dark:bg-gray-900 p-4 rounded-md shadow-sm">
                            <summary
                                class="flex justify-between items-center font-medium cursor-pointer text-gray-700 dark:text-white">
                                Berapa lama pengiriman biasanya?
                                <span class="ml-4 group-open:rotate-180 transition-transform">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">Pengiriman biasanya memakan waktu 2-5 hari
                                kerja, tergantung lokasi Anda.</p>
                        </details>

                        <details class="group bg-white dark:bg-gray-900 p-4 rounded-md shadow-sm">
                            <summary
                                class="flex justify-between items-center font-medium cursor-pointer text-gray-700 dark:text-white">
                                Apakah bisa COD?
                                <span class="ml-4 group-open:rotate-180 transition-transform">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">Saat ini kami belum mendukung pembayaran
                                COD. Kami menerima transfer bank dan e-wallet.</p>
                        </details>
                    </div>
                </div>
            </section>



            <!-- Newsletter section -->
            <div class="bg-white dark:bg-gray-900 py-16 sm:py-24">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Jangan
                        Ketinggalan Info</h2>
                    <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-400">Dapatkan update terbaru, koleksi
                        baru, dan penawaran eksklusif langsung ke inbox Anda.</p>
                    <form class="mt-10 flex max-w-md gap-x-4 mx-auto">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                            placeholder="Masukkan email Anda">
                        <button type="submit"
                            class="flex-none rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar</button>
                    </form>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-950" aria-labelledby="footer-heading">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
                <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="space-y-8">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Toko Sepatu MassDik</h1>
                        <p class="text-sm leading-6 text-gray-600 dark:text-gray-300">Membawa gaya dan kenyamanan ke
                            setiap langkah Anda.</p>
                        <div class="flex space-x-6">
                            <!-- Social icons here -->
                        </div>
                    </div>
                    <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Toko</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li><a href="@auth{{ url('/category/pria') }}@else{{ route('login') }}@endauth"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Pria</a>
                                    </li>
                                    <li><a href="@auth{{ url('/category/wanita') }}@else{{ route('login') }}@endauth"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Wanita</a>
                                    </li>
                                    <li><a href="@auth{{ url('/category/anak') }}@else{{ route('login') }}@endauth"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Anak-Anak</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-10 md:mt-0">
                                <h3 class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Perusahaan
                                </h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Tentang
                                            Kami</a></li>
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Karir</a>
                                    </li>
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Press</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Bantuan</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Kontak</a>
                                    </li>
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">FAQ</a>
                                    </li>
                                    <li><a href="#"
                                            class="text-sm leading-6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Pengembalian</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-16 border-t border-gray-900/10 dark:border-gray-700 pt-8 sm:mt-20 lg:mt-24">
                    <p class="text-xs leading-5 text-gray-500 dark:text-gray-400">© {{ date('Y') }} Toko Sepatu MassDik,
                        Inc. All
                        rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>