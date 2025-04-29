<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Return;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $activeRentals = Order::where('status', 'approved')
            ->where('rental_status', '!=', 'returned')
            ->with('user')
            ->latest()
            ->get();

        $returns = Returns::with(['order.user'])->latest()->get();

        return view('dashboard.returns', compact('activeRentals', 'returns'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'rental_status' => 'required|in:not_rented,rented,returned',
        ]);

        $order->update(['rental_status' => $request->rental_status]);

        return redirect()->route('returns.index')->with('success', 'Status peminjaman berhasil diperbarui');
    }

    public function processReturn(Request $request, Order $order)
    {
        $request->validate([
            'condition' => 'required|in:excellent,good,damaged,lost',
            'fine' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Returns::create([
            'order_id' => $order->id,
            'return_date' => now(),
            'condition' => $request->condition,
            'fine' => $request->fine,
            'notes' => $request->notes,
        ]);

        $order->update(['rental_status' => 'returned']);

        // Restock products if condition is good or excellent
        if (in_array($request->condition, ['excellent', 'good'])) {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return redirect()->route('returns.index')->with('success', 'Pengembalian berhasil diproses');
    }

    public function show(Returns $returns)
    {
        $return->load(['order.user', 'order.items.product']);
        return view('dashboard.return-detail', compact('return'));
    }
}