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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->decimal('jumlah_bayar', 15, 2);
            $table->decimal('sisa_bayar', 15, 2);
            $table->enum('tipe', ['DP', 'Lunas']);
            $table->enum('status_bayar', ['BL', 'Lunas'])->default('BL');
            $table->string('foto_bukti')->nullable();
            $table->date('tanggal_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
