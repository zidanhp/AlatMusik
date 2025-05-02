<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanan = DB::table('pemesanan as p')
            ->join('pengguna as u', 'p.id_pengguna', '=', 'u.id')
            ->select('p.*', 'u.username as nama_pelanggan', 'u.telepon')
            ->orderByDesc('p.tanggal_pemesanan')
            ->get();

        foreach ($pemesanan as $p) {
            $p->detail = DB::table('item_pemesanan as ip')
                ->join('produk as pr', 'ip.id_produk', '=', 'pr.id')
                ->select('ip.*', 'pr.nama as nama_produk', 'pr.path_gambar')
                ->where('ip.id_pemesanan', $p->id)
                ->get();
        }

        return view('dashboard.orders');
    }
}
