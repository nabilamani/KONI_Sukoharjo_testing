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
        Schema::create('athletes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name'); // Nama atlet
            $table->unsignedBigInteger('sport_category'); // Kategori olahraga
            $table->date('birth_date'); // Tempat tanggal lahir
            $table->enum('gender', ['Laki-laki', 'Perempuan']); // Jenis kelamin
            $table->decimal('weight', 5, 2); // Berat badan (dalam kg, misal 70.5)
            $table->decimal('height', 5, 2); // Tinggi badan (dalam cm, misal 180.0)
            $table->text('achievements')->nullable(); // Prestasi
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('athletes');
    }
};
