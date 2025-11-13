<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            $table->foreignId('owner_id')
                ->constrained('owners')
                ->cascadeOnDelete();

            $table->foreignId('meja_id')
                ->nullable()
                ->constrained('mejas')
                ->nullOnDelete();

            $table->string('nomor_pesanan');

            $table->date('tanggal_reservasi');
            $table->time('jam_reservasi');
            $table->integer('jumlah_tamu');

            $table->enum('area', ['Indoor', 'Outdoor', 'Semi Outdoor'])
                ->default('Indoor');

            $table->enum('status', ['pending', 'paid', 'cancelled', 'completed'])
                ->default('pending');

            $table->boolean('arrive')->default(0);

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
