<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Form pemesanan
    public function orderForm(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    // Proses simpan pesanan
    public function storeOrder(Request $request, Product $product)
    {
        $request->validate([
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $total = $product->price * $request->quantity;

        Order::create([
            'user_id'     => Auth::id(),
            'product_id'  => $product->id,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'quantity'    => $request->quantity,
            'total_price' => $total,
        ]);

        return redirect()->route('orders.my')->with('success', 'Pemesanan berhasil! ✨');
    }


    // Halaman sukses

    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.order.myorder', compact('orders')); // orders ya, bukan order
    }
}
