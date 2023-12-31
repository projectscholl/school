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
        Schema::create('tagihan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembayarans')->nullable();
            $table->foreignId('id_tagihan');
            $table->foreignId('id_murids');
            $table->string('status')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('nama_biaya');
            $table->integer('jumlah_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_details');
    }
};
