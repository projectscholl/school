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
        Schema::create('biayas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_angkatans');
            $table->foreignId('id_kelas');
            $table->foreignId('id_jurusans');
            $table->string('nama_biaya');
            $table->bigInteger('total_biaya');

            $table->set('status', ['routine', 'optional']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biayas');
    }
};
