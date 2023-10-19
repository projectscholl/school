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
        Schema::create('murids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->nullable();
            $table->foreignId('id_ayah')->nullable();
            $table->foreignId('id_ibu')->nullable();
            $table->string('name');
            $table->string('nisn');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->foreignId('id_angkatans')->nullable();
            $table->foreignId('id_jurusans')->nullable();
            $table->foreignId('id_kelas')->nullable();
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murids');
    }
};
