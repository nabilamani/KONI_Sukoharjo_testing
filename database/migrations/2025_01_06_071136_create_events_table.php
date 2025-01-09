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
        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name'); // Nama event
            $table->date('event_date'); // Tanggal event
            $table->unsignedBigInteger('sport_category')->nullable(); // Kategori olahraga
            $table->string('location'); // Lokasi event
            $table->string('banner')->nullable(); // Path ke banner/foto/poster event
            $table->text('location_map'); // Map iframe input for embedding Google Maps for the venue
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
        Schema::dropIfExists('events');
    }
};
