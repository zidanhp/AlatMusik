<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('dashboard.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('dashboard.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:Kordofon,Aerofon,Elektrofon,Membranofon,Idiofon',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('uploads', 'public');
        }

        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'path_gambar' => $path,
            'rating_rata' => 0.00,
            'total_ulasan' => 0
        ]);

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('dashboard.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:Kordofon,Aerofon,Elektrofon,Membranofon,Idiofon',
            'path_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('path_gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->path_gambar) {
                Storage::disk('public')->delete($produk->path_gambar);
            }
            $data['path_gambar'] = $request->file('path_gambar')->store('uploads', 'public');
        }

        $produk->update($data);

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        // Hapus gambar terkait
        if ($produk->path_gambar) {
            Storage::disk('public')->delete($produk->path_gambar);
        }
        
        $produk->delete();

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}