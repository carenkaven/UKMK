<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->string('telepon')->nullable();
            $table->string('gender')->nullable();
            $table->string('agama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('foto')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
