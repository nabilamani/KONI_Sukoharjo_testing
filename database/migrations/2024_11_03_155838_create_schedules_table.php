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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Schedule name
            $table->date('date'); // Date of the event
            $table->string('sport_category'); // Sport category of the event
            $table->string('venue_name'); // Name of the venue
            $table->text('venue_map'); // Map iframe input for embedding Google Maps for the venue
            $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
