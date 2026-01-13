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
        Schema::create('ukms', function (Blueprint $table) {
            $table->id('id_ukm');
            $table->string('nama_ukm');
            $table->text('deskripsi')->nullable();
            $table->string('ketua_ukm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukms');
    }
};
