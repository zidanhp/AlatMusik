@extends('layouts.main')
@section('title', 'Data Pemesanan')

@section('content')
<div class="main-content p-4">
  <h1 class="text-2xl font-bold text-center mb-4">Pemesanan</h1>
  <div class="responsive-table">
    <table class="table w-full bg-white shadow-lg rounded-lg overflow-hidden">
      <thead>
        <tr class="header-table">
          <th>Id Pemesanan</th>
          <th>Nama Pemesan</th>
          <th>Telepon</th>
          <th>Total Harga</th>
          <th>Tanggal Pemesanan</th>
          <th>Status</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pemesanan as $p)
        <tr class="{{ $p->id % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
          <td class="text-center">{{ $p->id }}</td>
          <td>{{ $p->nama_pelanggan }}</td>
          <td>{{ $p->telepon }}</td>
          <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</td>
          <td><span class="status-badge status-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
          <td>
            <button class="bg-blue-500 text-white px-4 py-1 rounded-md" onclick="document.getElementById('modal-{{ $p->id }}').showModal()">
              Detail
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@foreach ($pemesanan as $p)
<dialog id="modal-{{ $p->id }}" class="modal">
  <div class="modal-box max-w-3xl">
    <div class="flex justify-between mb-6">
      <div>
        <h3 class="font-bold text-xl">#{{ $p->id }}</h3>
        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</p>
      </div>
      <form method="dialog">
        <button class="btn btn-circle btn-sm">✕</button>
      </form>
    </div>
    
    <div class="mb-6 space-y-2">
      <p><span class="font-semibold">Nama:</span> {{ $p->nama_pelanggan }}</p>
      <p><span class="font-semibold">Telepon:</span> {{ $p->telepon }}</p>
      <p>
        <span class="font-semibold">Status:</span> 
        <span class="badge badge-{{ $p->status === 'selesai' ? 'success' : ($p->status === 'proses' ? 'warning' : 'error') }}">
          {{ ucfirst($p->status) }}
        </span>
      </p>
    </div>
    
    <div class="divider my-4"></div>
    
    <div class="mb-6">
      <h4 class="font-bold text-lg mb-3">Detail Alat Musik</h4>
      <div class="overflow-x-auto">
        <table class="table table-zebra">
          <thead>
            <tr class="bg-gray-100">
              <th class="text-center">Gambar</th>
              <th>Nama Alat</th>
              <th class="text-center">Lama Sewa</th>
              <th class="text-center">Jumlah</th>
              <th class="text-right">Harga/Hari</th>
              <th class="text-right">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($p->detail as $item)
            <tr>
              <td class="text-center">
                @if ($item->path_gambar)
                  <img src="{{ asset($item->path_gambar) }}" class="w-16 h-16 object-contain mx-auto">
                @else
                  <div class="w-16 h-16 bg-gray-200 flex items-center justify-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                @endif
              </td>
              <td>{{ $item->nama_produk }}</td>
              <td class="text-center">{{ $item->hari_sewa }} Hari</td>
              <td class="text-center">{{ $item->jumlah }}</td>
              <td class="text-right">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
              <td class="text-right">Rp {{ number_format($item->harga_per_hari * $item->hari_sewa * $item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-gray-50">
              <td colspan="5" class="text-right font-bold">Total:</td>
              <td class="text-right font-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    
    <div class="modal-action">
      <form method="dialog">
        <button class="btn btn-primary">Tutup</button>
      </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
@endforeach
@endsection
