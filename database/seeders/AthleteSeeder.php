<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $athletes = [];

        for ($i = 0; $i < 200; $i++) {
            $athletes[] = [
                'id' => Str::uuid(),
                'name' => $faker->name,
                'sport_category' => $faker->numberBetween(1, 4), // ID kategori olahraga antara 1-4
                'birth_date' => $faker->date('Y-m-d', '-18 years'), // Usia minimal 18 tahun
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'weight' => $faker->randomFloat(2, 45, 120), // Berat badan antara 45kg hingga 120kg
                'height' => $faker->randomFloat(2, 150, 210), // Tinggi badan antara 150cm hingga 210cm
                'achievements' => $faker->optional()->sentence(6), // Prestasi opsional
                'photo' => $faker->optional()->imageUrl(200, 200, 'sports', true, 'athlete'), // URL foto opsional
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke tabel athletes
        DB::table('athletes')->insert($athletes);
    }
}
