@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="mb-4">
    <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" 
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
        + Tambah Produk
    </button>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Gambar</th>
                <th scope="col" class="px-6 py-3">Nama</th>
                <th scope="col" class="px-6 py-3">Kategori</th>
                <th scope="col" class="px-6 py-3">Stok</th>
                <th scope="col" class="px-6 py-3">Harga</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{ $product->id }}</td>
                <td class="px-6 py-4">
                    @if($product->image_path)
                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                    @endif
                </td>
                <td class="px-6 py-4">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->category }}</td>
                <td class="px-6 py-4">{{ $product->stock }}</td>
                <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <button data-modal-target="edit-product-modal-{{ $product->id }}" data-modal-toggle="edit-product-modal-{{ $product->id }}" 
                        class="font-medium text-yellow-600 hover:underline">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div id="add-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Tambah Produk Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-product-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="Kordofon">Kordofon</option>
                                <option value="Aerofon">Aerofon</option>
                                <option value="Elektrofon">Elektrofon</option>
                                <option value="Membranofon">Membranofon</option>
                                <option value="Idiofon">Idiofon</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                            <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required min="0">
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required min="0">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Gambar Produk</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image" name="image" type="file">
                    </div>
                </div>
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                    <button type="button" data-modal-hide="add-product-modal" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modals -->
@foreach($products as $product)
<div id="edit-product-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify