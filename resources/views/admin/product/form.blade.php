{{-- File: resources/views/admin/product/form.blade.php --}}

{{-- Kita menggunakan x-data dari Alpine.js untuk pratinjau gambar --}}
<div x-data="{
    imagePreview: '{{ isset($product) && $product->image ? asset('storage/' . $product->image) : null }}',
    fileChanged(event) {
        const file = event.target.files[0];
        if (file) {
            this.imagePreview = URL.createObjectURL(file);
        }
    }
}">

    <form action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
        method="POST" enctype="multipart/form-data">

        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        {{-- Main Grid Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom Utama (Kiri) untuk detail produk -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Detail Produk Dasar -->
                <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-lg">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        Detail Produk</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nama
                                Sepatu</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}"
                                    required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            </div>
                        </div>
                        <div>
                            <label for="description"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Deskripsi</label>
                            <div class="mt-2">
                                <textarea id="description" name="description" rows="5"
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Harga dan Inventaris -->
                <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-lg">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        Harga & Inventaris</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Harga</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="price" id="price" step="1"
                                    value="{{ old('price', $product->price ?? '') }}" required
                                    class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-white dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            </div>
                        </div>
                        <div>
                            <label for="size"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Ukuran</label>
                            <div class="mt-2">
                                <input type="text" name="size" id="size" value="{{ old('size', $product->size ?? '') }}"
                                    required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            </div>
                        </div>
                        <div>
                            <label for="stock"
                                class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Stok</label>
                            <div class="mt-2">
                                <input type="number" name="stock" id="stock"
                                    value="{{ old('stock', $product->stock ?? '') }}" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Samping (Kanan) untuk gambar dan aksi -->
            <div class="space-y-8">
                <!-- Gambar Produk -->
                <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-lg">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        Gambar Produk</h3>

                    <!-- Image Preview -->
                    <div
                        class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700 mb-4 flex items-center justify-center">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!imagePreview">
                            <div class="text-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-2">Pratinjau Gambar</p>
                            </div>
                        </template>
                    </div>

                    <!-- Upload Box -->
                    <label for="image"
                        class="relative cursor-pointer rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 p-4 flex justify-center items-center text-center hover:border-indigo-500 transition-colors">
                        <div class="space-y-1">
                            <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-semibold text-indigo-600 dark:text-indigo-400">Unggah file</span>
                                <input id="image" name="image" type="file" class="sr-only" @change="fileChanged($event)"
                                    accept="image/*">
                                <p class="pl-1">atau tarik dan lepas</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF hingga 10MB</p>
                        </div>
                    </label>
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold py-3 px-4 rounded-lg hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        {{ isset($product) ? 'Update Produk' : 'Simpan Produk Baru' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>