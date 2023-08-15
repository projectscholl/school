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
            $table->foreignId('id_wali_murid')->nullable();
            $table->string('name');
            $table->string('nisn');
            $table->set('jurusan', ['teknik mesin', 'teknik komputer']);
            $table->string('kelas');
            $table->foreignId('biaya_id');
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
