<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('sport_category'); // Kategori olahraga
            $table->string('event_type'); // Kelompok cabor (contoh: ganda-putri, ganda-putra)
            $table->string('athlete_name'); // Nama atlet
            $table->text('description')->nullable(); // Keterangan prestasi
            $table->string('region_level'); // Tingkat wilayah (contoh: kabupaten, provinsi, nasional)
            $table->string('rank'); // Peringkat (contoh: Juara 1, Juara 2, dll.)
            $table->date('certificate_date'); // Tanggal piagam
            $table->timestamps();

            $table->foreign('sport_category')->references('id')->on('sport_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
};