<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['makanan', 'minuman', 'dessert'])->default('makanan');
            $table->decimal('harga', 12, 2);
            $table->string('foto')->default('images/menu/placeholder.png');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
