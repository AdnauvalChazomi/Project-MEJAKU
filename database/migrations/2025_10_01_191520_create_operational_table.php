<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operational', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
            
            $table->time('jam_buka');
            $table->time('jam_tutup');
            
            $table->integer('jumlah_meja');
            $table->integer('jumlah_kursi');
            
            // Kategori layanan (dine-in, reservasi grup, private room, dll.)
            $table->string('kategori_layanan');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operational_data');
    }
};
