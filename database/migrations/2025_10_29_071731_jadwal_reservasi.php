<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operational_id')->constrained('operational')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('area', ['Indoor', 'Outdoor', 'Semi Outdoor']);
            $table->integer('kapasitas')->default(10);
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
