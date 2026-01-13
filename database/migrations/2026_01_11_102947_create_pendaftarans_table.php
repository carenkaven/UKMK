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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->date('tanggal_daftar');
            $table->string('status_verifikasi')->default('Pending');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_ukm');

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_ukm')->references('id_ukm')->on('ukms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
