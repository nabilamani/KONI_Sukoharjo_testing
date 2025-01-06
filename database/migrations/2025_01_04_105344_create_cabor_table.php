<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sport_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cabor')->unique(); // Nama Federasi
            $table->string('sport_category');
            $table->text('deskripsi')->nullable();
            $table->string('puslatcab')->nullable();
            $table->string('kontak')->nullable();
            $table->string('logo')->nullable();
            $table->string('level')->nullable(); // Tambahkan kolom level di sini
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_categories');
    }
};
