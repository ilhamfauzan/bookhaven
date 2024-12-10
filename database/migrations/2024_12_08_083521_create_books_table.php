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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author'); 
            $table->string('slug')->unique(); 
            $table->text('description'); 
            $table->text('category'); 
            $table->decimal('price', 15, 2); 
            $table->integer('stock'); 
            $table->string('image_url')->nullable(); // URL Gambar Buku ???
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
