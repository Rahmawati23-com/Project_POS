<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks');
            $table->string('nama_pembeli');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
