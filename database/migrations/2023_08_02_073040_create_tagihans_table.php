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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_biayas');
            $table->foreignId('id_murids');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('mounth')->nullable();
            $table->integer('amount');
            $table->string('status')->default('BELUM');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
