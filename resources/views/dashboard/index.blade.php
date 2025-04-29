@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    @include('components.stat-card', [
        'title' => 'Total Pemesanan',
        'value' => $totalOrders,
        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'color' => 'bg-gradient-to-br from-amber-200 to-gray-600 to-gray-900'
    ])

    @include('components.stat-card', [
        'title' => 'Total Produk',
        'value' => $totalProducts,
        'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        'color' => 'bg-gradient-to-br from-amber-200 to-gray-600 to-gray-900'
    ])

    @include('components.stat-card', [
        'title' => 'Total Pelanggan',
        'value' => $totalCustomers,
        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        'color' => 'bg-gradient-to-br from-amber-200 to-gray-600 to-gray-900'
    ])

    @include('components.stat-card', [
        'title' => 'Total Pengembalian',
        'value' => $totalReturns,
        'icon' => 'M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z',
        'color' => 'bg-gradient-to-br from-amber-200 to-gray-600 to-gray-900'
    ])
</div>
@endsection