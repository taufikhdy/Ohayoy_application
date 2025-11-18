<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->string('no_struk')->unique();

            $table->string('meja_id');
            $table->string('nama_pelanggan');
            $table->string('order_id');
            // $table->foreignId('kasir_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('kasir_id');
            $table->string('nama_kasir');

            $table->integer('total_bayar');

            $table->enum('status_bayar', ['pending', 'paid'])->default('pending');

            $table->time('waktu');
            $table->date('tanggal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
