<form action="{{ isset($product) ? route('admin.product.edit', $product->id) : route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <div>
        <label for="name">Nama Sepatu</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <div>
        <label for="description">Deskripsi Sepatu</label>
        <textarea name="description" id="description">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="price">Harga</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price ?? '') }}" required>
    </div>

    <div>
        <label for="size">Ukuran</label>
        <input type="text" name="size" id="size" value="{{ old('size', $product->size ?? '') }}" required>
    </div>

    <div>
        <label for="stock">Stok</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}" required>
    </div>

    <div>
        <label for="image">Gambar Sepatu</label>
        <input type="file" name="image" id="image" accept="image/*">
        @if(isset($product) && $product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Sepatu" width="100">
            </div>
        @endif
    </div>

    <button type="submit">{{ isset($product) ? 'Update' : 'Simpan' }}</button>
</form>