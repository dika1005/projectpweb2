<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showProducts()
    {
        $products = Product::latest()->paginate(12);
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
}
