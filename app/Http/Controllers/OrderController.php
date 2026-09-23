<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;

class OrderController extends Controller
{
    // 1. Menampilkan katalog menu untuk customer
    public function index()
    {
        $foods = Food::all();
        return view('customer.index', compact('foods'));
    }

    // 2. Memproses checkout / pesanan dari customer
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|integer',
            'food_id' => 'required|array',
            'quantity' => 'required|array',
        ]);

        // Hitung total harga dan simpan pesanan
        $totalPrice = 0;
        $orderItems = [];

        foreach ($request->food_id as $index => $foodId) {
            $qty = $request->quantity[$index];
            if ($qty > 0) {
                $food = Food::findOrFail($foodId);
                $subtotal = $food->price * $qty;
                $totalPrice += $subtotal;

                $orderItems[] = [
                    'food_id' => $foodId,
                    'quantity' => $qty,
                    'subtotal' => $subtotal,
                ];
            }
        }

        if (empty($orderItems)) {
            return back()->with('error', 'Pilih minimal satu menu makanan!');
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($orderItems as $item) {
            $order->orderDetails()->create($item);
        }

        return redirect()->route('customer.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // 3. Menampilkan rekap pesanan masuk di Admin Dashboard (Breeze)
    public function adminDashboard()
    {
        $orders = Order::with('orderDetails.food')->latest()->get();
        return view('dashboard', compact('orders'));
    }

    // 4. Memperbarui status pesanan oleh admin
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('dashboard')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}