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
    Schema::create('coaches', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('sport_category'); // Foreign key
        $table->integer('age');
        $table->string('address');
        $table->string('whatsapp');
        $table->string('instagram');
        $table->text('description')->nullable();
        $table->string('photo')->nullable();
        $table->timestamps();

        // Relasi ke tabel sport_categories
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
        Schema::dropIfExists('coaches');
    }
};
