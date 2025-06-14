<?php

namespace App\Http\Controllers;

// Tambahkan use statement yang dibutuhkan! Jangan lupa!
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama admin.
     */
    public function index()
    {
        return view('admin.dashboard'); // Ini untuk dashboard-mu
    }

    // --- MULAI LOGIKA PRODUK ---
    // Jangan campur aduk! Aku beri komentar biar kamu tidak bingung.

    /**
     * Menampilkan halaman daftar produk.
     * (Sebelumnya ada di ProductController@index)
     */
    public function productIndex()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', compact('products')); // ⬅️ Kirim 'products' ke 'index' view
    }



    /**
     * Menampilkan form untuk membuat produk baru.
     * (Sebelumnya ada di ProductController@create)
     */
    public function productCreate()
    {
        return view('admin.product.create');
    }

    /**
     * Menyimpan produk baru ke database.
     * (Sebelumnya ada di ProductController@store)
     */
    public function productStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'size' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function productEdit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Mengupdate data produk di database.
     * (Sebelumnya ada di ProductController@update)
     */
    public function productUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'size' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari database.
     * (Aku tambahkan ini biar lengkap. Harusnya kamu sudah tahu.)
     */
    public function productDestroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
