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

{{-- Modal --}}
@foreach ($pemesanan as $p)
<dialog id="modal-{{ $p->id }}" class="modal">
  <div class="modal-box">
    <div class="flex justify-between mb-4">
      <h3 class="font-bold text-lg">Detail Pemesanan #{{ $p->id }}</h3>
      <form method="dialog">
        <button class="text-2xl font-bold">&times;</button>
      </form>
    </div>
    <div class="mb-4">
      <p>Nama: {{ $p->nama_pelanggan }}</p>
      <p>Telepon: {{ $p->telepon }}</p>
      <p>Tanggal: {{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</p>
      <p>Status: <span class="status-badge status-{{ $p->status }}">{{ ucfirst($p->status) }}</span></p>
    </div>
    <div class="responsive-table">
      <table class="table w-full">
        <thead>
          <tr>
            <th>Id</th>
            <th>Gambar</th>
            <th>Nama Alat Musik</th>
            <th>Lama Sewa</th>
            <th>Jumlah</th>
            <th>Harga per Hari</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($p->detail as $item)
          <tr class="{{ $item->id % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
            <td class="text-center">{{ $item->id_produk }}</td>
            <td>
              @if ($item->path_gambar)
                <img src="{{ asset($item->path_gambar) }}" class="w-20 h-auto mx-auto">
              @else
                <div class="w-20 h-20 bg-gray-200 flex items-center justify-center mx-auto">No Image</div>
              @endif
            </td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->hari_sewa }} Hari</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->harga_per_hari * $item->hari_sewa * $item->jumlah, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6" class="text-right font-semibold">Total:</td>
            <td class="font-semibold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="modal-action mt-4">
      <form method="dialog"><button class="btn">Tutup</button></form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
@endforeach
@endsection
