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
            $table->unsignedBigInteger('sport_category');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->date('birth_date');
            $table->integer('age')->nullable(); // Optional if you want to store age
            $table->string('license')->nullable();
            $table->text('experience')->nullable();
            $table->string('photo')->nullable();
            $table->string('WhatsApp')->nullable(); // New column for contact link (e.g., social media link)
            $table->string('Instagram')->nullable(); // New column for contact link (e.g., social media link)
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
        Schema::dropIfExists('referees');
    }
};
