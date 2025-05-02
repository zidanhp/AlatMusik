<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_create_produk_table.php
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->integer('stok');
            $table->decimal('harga', 10, 2);
            $table->string('kategori');
            $table->string('path_gambar')->nullable();
        });
        
    }
};