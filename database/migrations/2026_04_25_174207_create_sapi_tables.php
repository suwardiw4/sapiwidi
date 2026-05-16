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
        Schema::create('sapis', function (Blueprint $table) {
            $table->id(); //disini woi kalau mau nambahin kolom kolom
            $table->string('kode_sapi')->unique(); 
            $table->string('jenis_sapi');
            $table->decimal('bobot', 8, 2); 
            $table->integer('harga_jual');
            $table->string('status')->default('Tersedia'); // Default sapi baru adalah Tersedia
            $table->string('foto_path')->nullable(); 
            $table->timestamps(); // Buat kolom created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sapis');
    }
};
