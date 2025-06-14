<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ selectedProduct: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div @click="selectedProduct = {{ $product->toJson() }}" class="cursor-pointer">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                    Tidak ada gambar
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-semibold cursor-pointer hover:underline"
                                @click="selectedProduct = {{ $product->toJson() }}">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 text-sm">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-600 text-sm">Stok: {{ $product->stock }} pcs</p>
                            <p class="text-gray-600 text-sm mb-2">Ukuran: {{ $product->size }}</p>

                            <div class="flex gap-3">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded hover:bg-indigo-200">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada produk.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>

        <!-- 💥 Modal Detail Produk -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" x-show="selectedProduct"
            style="display: none;" x-transition>
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                <button @click="selectedProduct = null"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                <template x-if="selectedProduct">
                    <div>
                        <img :src="'/storage/' + selectedProduct.image" alt=""
                            class="w-full h-64 object-cover rounded mb-4" x-show="selectedProduct.image">

                        <h2 class="text-xl font-bold mb-2" x-text="selectedProduct.name"></h2>
                        <p class="text-gray-700 mb-1">Deskripsi: <span x-text="selectedProduct.description"></span></p>
                        <p class="text-gray-700 mb-1">Harga: Rp <span
                                x-text="Number(selectedProduct.price).toLocaleString('id-ID')"></span></p>
                        <p class="text-gray-700 mb-1">Stok: <span x-text="selectedProduct.stock"></span> pcs</p>
                        <p class="text-gray-700 mb-1">Ukuran: <span x-text="selectedProduct.size"></span></p>
                        <p class="text-gray-600 mt-2 text-sm" x-text="selectedProduct.description"></p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-app-layout>