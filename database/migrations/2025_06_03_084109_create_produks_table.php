<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('nama', 45);
            $table->double('harga');
            $table->integer('stok');
            $table->integer('rating')->nullable();
            $table->integer('min_stok')->nullable();
            $table->unsignedBigInteger('jenis_produk_id');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('jenis_produk_id')->references('id')->on('jenis_produks');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
