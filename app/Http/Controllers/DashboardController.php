<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Return;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'totalCustomers' => User::where('role', 'staff')->count(),
            'totalReturns' => Returns::count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}