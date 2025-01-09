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
            $table->time('time'); // Time of the event
            $table->unsignedBigInteger('sport_category')->nullable(); // Sport category of the event
            $table->string('venue_name'); // Name of the venue
            $table->text('venue_map'); // Map iframe input for embedding Google Maps for the venue
            $table->text('notes')->nullable(); // Optional notes about the schedule
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
        Schema::dropIfExists('schedules');
    }
};
