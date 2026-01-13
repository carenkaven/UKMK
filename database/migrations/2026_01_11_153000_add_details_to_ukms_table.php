<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('ketua_ukm');
            $table->string('jadwal')->nullable()->after('gambar');
            $table->string('prestasi')->nullable()->after('jadwal');
            $table->string('kontak')->nullable()->after('prestasi');
        });
    }

    public function down()
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'jadwal', 'prestasi', 'kontak']);
        });
    }
};
