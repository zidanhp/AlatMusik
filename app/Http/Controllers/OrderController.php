<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('dashboard.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('dashboard.order-detail', compact('order'));
    }

    public function approve(Order $order)
    {
        $order->approve();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil disetujui');
    }

    public function complete(Order $order)
    {
        $order->complete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diselesaikan');
    }

    public function cancel(Order $order)
    {
        $order->cancel();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibatalkan');
    }
}