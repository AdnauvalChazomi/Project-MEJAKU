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

            $table->enum('hari', [
                'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu', 'Setiap hari'
            ]);

            $table->time('jam_buka');
            $table->time('jam_tutup');

            $table->enum('area', ['Indoor', 'Outdoor', 'Semi Outdoor'])->nullable();

            $table->string('kategori_layanan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operational');
    }
};
