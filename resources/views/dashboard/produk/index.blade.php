@extends('layouts.main')

@section('title', 'Kelola Produk')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Data Produk</h1>
        <a href="{{ route('dashboard.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $index => $produk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($produk->path_gambar)
                            <img src="{{ asset($produk->path_gambar) }}" class="w-16 h-16 object-cover">
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td>{{ $produk->nama }}</td>
                    <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>
                        <span class="badge badge-{{ 
                            $produk->kategori == 'Kordofon' ? 'primary' : 
                            ($produk->kategori == 'Aerofon' ? 'secondary' : 
                            ($produk->kategori == 'Elektrofon' ? 'accent' : 
                            ($produk->kategori == 'Membranofon' ? 'info' : 'warning')))
                        }}">
                            {{ $produk->kategori }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">{{ $produk->rating_rata }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-gray-500 text-sm ml-1">({{ $produk->total_ulasan }})</span>
                        </div>
                    </td>
                    <td class="flex gap-2">
                        <!-- Tombol edit (modal) -->
                        <button onclick="document.getElementById('editModal-{{ $produk->id }}').showModal()" class="btn btn-sm btn-warning">Ubah</button>
                        <!-- Tombol hapus -->
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Ubah Produk -->
                <dialog id="editModal-{{ $produk->id }}" class="modal">
                    <div class="modal-box">
                        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <h3 class="font-bold text-lg">Ubah Produk</h3>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nama Produk</span>
                                </label>
                                <input type="text" name="nama" value="{{ $produk->nama }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Harga per Hari</span>
                                </label>
                                <input type="number" name="harga" value="{{ $produk->harga }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Stok</span>
                                </label>
                                <input type="number" name="stok" value="{{ $produk->stok }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Kategori</span>
                                </label>
                                <select name="kategori" class="select select-bordered w-full" required>
                                    <option value="Kordofon" {{ $produk->kategori == 'Kordofon' ? 'selected' : '' }}>Kordofon</option>
                                    <option value="Aerofon" {{ $produk->kategori == 'Aerofon' ? 'selected' : '' }}>Aerofon</option>
                                    <option value="Elektrofon" {{ $produk->kategori == 'Elektrofon' ? 'selected' : '' }}>Elektrofon</option>
                                    <option value="Membranofon" {{ $produk->kategori == 'Membranofon' ? 'selected' : '' }}>Membranofon</option>
                                    <option value="Idiofon" {{ $produk->kategori == 'Idiofon' ? 'selected' : '' }}>Idiofon</option>
                                </select>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Gambar Produk</span>
                                </label>
                                <input type="file" name="path_gambar" class="file-input file-input-bordered w-full">
                                <label class="label">
                                    <span class="label-text-alt">Kosongkan jika tidak ingin mengubah gambar</span>
                                </label>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Deskripsi</span>
                                </label>
                                <textarea name="deskripsi" class="textarea textarea-bordered h-24">{{ $produk->deskripsi }}</textarea>
                            </div>
                            
                            <div class="modal-action">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" onclick="document.getElementById('editModal-{{ $produk->id }}').close()" class="btn">Batal</button>
                            </div>
                        </form>
                    </div>
                </dialog>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection