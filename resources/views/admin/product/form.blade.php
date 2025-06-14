<form action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
    method="POST" enctype="multipart/form-data"
    class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-8 mb-8 overflow-auto transition-all duration-300 border border-gray-200">

    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Form {{ isset($product) ? 'Edit' : 'Tambah' }} Sepatu
    </h2>

    <div class="grid grid-cols-1 gap-5">
        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-1">Nama Sepatu</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-semibold mb-1">Deskripsi Sepatu</label>
            <textarea name="description" id="description" rows="3"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-gray-700 font-semibold mb-1">Harga</label>
                <input type="number" name="price" id="price" step="0.01"
                    value="{{ old('price', $product->price ?? '') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="size" class="block text-gray-700 font-semibold mb-1">Ukuran</label>
                <input type="text" name="size" id="size" value="{{ old('size', $product->size ?? '') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label for="stock" class="block text-gray-700 font-semibold mb-1">Stok</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="image" class="block text-gray-700 font-semibold mb-1">Gambar Sepatu</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">

            @if(isset($product) && $product->image)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Sepatu" width="120"
                        class="rounded-xl shadow">
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold py-2 px-4 rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all duration-300">
            {{ isset($product) ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>