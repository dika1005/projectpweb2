<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showProducts(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('user.order.index', compact('products'));
    }

    // Form pemesanan
    public function orderForm(Product $product)
    {
        return view('user.order.order', compact('product'));
    }

    // Proses simpan pesanan
    public function storeOrder(Request $request, Product $product)
    {
        $request->validate([
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cek stok dulu
        if ($product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak cukup!']);
        }

        // Hitung total
        $total = $product->price * $request->quantity;

        // Simpan pesanan
        Order::create([
            'user_id'     => Auth::id(),
            'product_id'  => $product->id,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'quantity'    => $request->quantity,
            'total_price' => $total,
            'status'      => 'Pending',
        ]);

        // Kurangi stok
        $product->decrement('stock', $request->quantity);

        return redirect()->route('orders.my')->with('success', 'Pemesanan berhasil! ✨');
    }



    // Halaman sukses

    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'Success')
            ->latest()
            ->get();

        return view('user.order.myorder', compact('orders')); // orders ya, bukan order
    }

    public function historyOrders()
    {
        $orders = \App\Models\Order::with('product')
            ->where('user_id', Auth::id())
            ->where('status', '=', 'Success')
            ->orderByDesc('created_at')
            ->get();

        return view('user.order.history', compact('orders'));
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('search');

        // Kalau search kosong, langsung tampilkan semua produk terbaru dengan pagination 12
        if (!$searchTerm) {
            $products = Product::latest()->paginate(12);
        } else {
            // Cari produk berdasarkan nama, case insensitive
            $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
                ->latest()
                ->paginate(12);
        }

        // Return view sama variable products dan juga searchTerm biar bisa dipake di view
        return view('user.order.index', compact('products', 'searchTerm'));
    }
}
