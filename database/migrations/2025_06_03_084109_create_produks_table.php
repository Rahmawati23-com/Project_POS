<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('kategori_id')->nullable(); // ⬅️ Tambahkan ini
            $table->unsignedBigInteger('jenis_produk_id')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
