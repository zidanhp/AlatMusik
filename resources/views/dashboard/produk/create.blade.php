<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nama_produk" placeholder="Nama Produk">
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <input type="number" name="stok" placeholder="Stok">
    <input type="number" step="0.01" name="harga" placeholder="Harga">
    <input type="text" name="kategori" placeholder="Kategori">
    <input type="file" name="gambar">
    <button type="submit">Simpan</button>
</form>
