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
    Schema::create('referees', function (Blueprint $table) {
        $table->string('id')->primary();
        $table->string('name');
        $table->string('sport_category');
        $table->enum('gender', ['Laki-laki', 'Perempuan']);
        $table->date('birth_date');
        $table->integer('age')->nullable(); // Optional if you want to store age
        $table->string('license')->nullable();
        $table->text('experience')->nullable();
        $table->string('photo')->nullable();
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
        Schema::dropIfExists('referees');
    }
};
