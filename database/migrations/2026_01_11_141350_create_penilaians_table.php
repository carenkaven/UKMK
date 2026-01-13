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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_sub_kriteria');
            $table->integer('nilai'); // Stored value to lock history
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_sub_kriteria')->references('id_sub_kriteria')->on('sub_kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
