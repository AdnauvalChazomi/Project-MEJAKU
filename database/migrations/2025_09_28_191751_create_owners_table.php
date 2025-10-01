<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_restoran');
            $table->text('alamat_restoran');
            $table->text('summary')->nullable();
            $table->text('lokasi_restoran')->nullable();
            $table->string('foto_restoran')->nullable();
            $table->string('nib')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
