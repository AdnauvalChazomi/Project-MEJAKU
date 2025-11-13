<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('owners')
                ->cascadeOnDelete();

            $table->string('kode')->unique();
            $table->string('nama_promo');
            $table->enum('tipe_diskon', ['persentase', 'nominal'])->default('persentase');
            $table->decimal('nilai_diskon', 12, 2);

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->integer('batas_penggunaan')->nullable();
            $table->integer('digunakan')->default(0);

            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
