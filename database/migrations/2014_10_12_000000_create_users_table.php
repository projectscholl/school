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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('id_orangtua')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['ADMIN', 'WALI']);
            $table->integer('status')->default(1)->nullable();
            $table->string('telepon');
            $table->string('hubungan')->nullable();
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
