<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Nama tabel (opsional kalau nama model == nama tabel)
    protected $table = 'products';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'stock',
        'image'
    ];

    // --- CRUD Manual ---

    // 🔍 Ambil semua produk
    public static function getAllProducts()
    {
        return self::all();
    }

    // 🔍 Ambil satu produk berdasarkan ID
    public static function getProductById($id)
    {
        return self::find($id);
    }

    // ➕ Tambah produk baru
    public static function createProduct($data)
    {
        return self::create($data);
    }

    // ✏️ Update produk
    public static function updateProduct($id, $data)
    {
        $product = self::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    // 🗑️ Hapus produk
    public static function deleteProduct($id)
    {
        $product = self::find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
