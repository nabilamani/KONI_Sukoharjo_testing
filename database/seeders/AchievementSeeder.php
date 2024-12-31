<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;
use Faker\Factory as Faker;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $sportCategories = [
            'Badminton',
            'Sepak Bola',
            'Bola Basket',
            'Bola Voli',
            'Balap Sepeda',
            'Atletik',
            'Renang',
            'Tinju',
            'Pencak Silat',
            'Futsal'
        ];
        $eventTypes = ['Individu', 'Ganda Putra', 'Ganda Putri', 'Tim'];
        $regionLevels = ['Kota', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];
        $ranks = ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Harapan 3'];

        for ($i = 1; $i <= 70; $i++) {
            Achievement::create([
                'id' => 'ACH' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'sport_category' => $faker->randomElement($sportCategories),
                'event_type' => $faker->randomElement($eventTypes),
                'athlete_name' => $faker->name,
                'description' => $faker->sentence,
                'region_level' => $faker->randomElement($regionLevels),
                'rank' => $faker->randomElement($ranks),
                'certificate_date' => $faker->date('Y-m-d', 'now')
            ]);
        }
    }
}
