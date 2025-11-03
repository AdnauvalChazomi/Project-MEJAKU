<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('owners')
                ->onDelete('cascade');

            $table->integer('nomor');

            $table->enum('status', ['tersedia', 'digunakan'])
                ->default('tersedia');

            $table->timestamps();

            $table->unique(['owner_id', 'nomor']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};
