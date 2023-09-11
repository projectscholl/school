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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tagihans');
            $table->foreignId('id_users');
            $table->string('payment_status')->default('Belum Di Konfirmasi');
            $table->string('payment_links')->nullable();
            $table->string('total_bayar');
            $table->string('nama_pengirim')->nullable();
            $table->string('rek_pengirim')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->string('identitas_penerima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
