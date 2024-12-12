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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Relasi dengan pengguna
            $table->unsignedBigInteger('book_id'); // Relasi dengan buku
            $table->integer('quantity'); // Jumlah buku yang dibeli
            $table->decimal('total_price', 10, 2); // Total harga transaksi
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed', 'Canceled', 'Refunded'])->default('Pending'); // Status pembayaran
            $table->enum('transaction_status', ['Processing','Canceled', 'Completed'])->default('Processing'); // Status transaksi
            $table->timestamp('transaction_date')->useCurrent(); // Tanggal transaksi
            $table->string('address'); // Alamat pengiriman
            $table->enum('shipping_status', ['Pending', 'Shipped', 'Delivered'])->nullable(); // Status pengiriman
            $table->string('payment_method'); // Metode pembayaran
            $table->string('payment_reference')->nullable(); // Referensi pembayaran

            $table->timestamps();

            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
