@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">ID Pemesanan</th>
                <th scope="col" class="px-6 py-3">Nama Pemesan</th>
                <th scope="col" class="px-6 py-3">Telepon</th>
                <th scope="col" class="px-6 py-3">Total Harga</th>
                <th scope="col" class="px-6 py-3">Tanggal Pemesanan</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{ $order->id }}</td>
                <td class="px-6 py-4">{{ $order->customer->name }}</td>
                <td class="px-6 py-4">{{ $order->customer->phone }}</td>
                <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-white 
                        @if($order->status == 'menunggu') bg-red-500
                        @elseif($order->status == 'disetujui') bg-cyan-500
                        @elseif($order->status == 'selesai') bg-green-500
                        @else bg-gray-500 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <button data-modal-target="order-modal-{{ $order->id }}" data-modal-toggle="order-modal-{{ $order->id }}" 
                        class="bg-blue-500 text-white px-4 py-1 rounded-md">
                        Detail
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach($orders as $order)
<!-- Modal -->
<div id="order-modal-{{ $order->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Detail Pemesanan #{{ $order->id }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="order-modal-{{ $order->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-4">
                    <h4 class="font-semibold">Info Pelanggan:</h4>
                    <p>Nama: {{ $order->customer->name }}</p>
                    <p>Telepon: {{ $order->customer->phone }}</p>
                    <p>Tanggal: {{ $order->created_at->format('d-m-Y H:i') }}</p>
                    <p>Status: 
                        <span class="px-2 py-1 rounded text-white 
                            @if($order->status == 'menunggu') bg-red-500
                            @elseif($order->status == 'disetujui') bg-cyan-500
                            @elseif($order->status == 'selesai') bg-green-500
                            @else bg-gray-500 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Gambar</th>
                                <th scope="col" class="px-6 py-3">Nama Alat Musik</th>
                                <th scope="col" class="px-6 py-3">Lama Sewa</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Harga per Hari</th>
                                <th scope="col" class="px-6 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $item->product_id }}</td>
                                <td class="px-6 py-4">
                                    @if($item->product->image_path)
                                    <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-20 h-auto">
                                    @else
                                    <div class="w-20 h-20 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $item->product->name }}</td>
                                <td class="px-6 py-4">{{ $item->rent_days }} Hari</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($item->price_per_day, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($item->price_per_day * $item->rent_days * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900">
                                <td colspan="6" class="px-6 py-3 text-right">Total:</td>
                                <td class="px-6 py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                @if($order->status == 'menunggu')
                <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                    @csrf
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Setujui
                    </button>
                </form>
                @endif
                <button data-modal-hide="order-modal-{{ $order->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection