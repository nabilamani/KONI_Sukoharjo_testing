<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 70; $i++) {
            $data[] = [
                'id' => Str::uuid()->toString(),
                'sport_category' => rand(1, 4), // Pastikan id kategori olahraga ada di tabel sport_categories
                'event_type' => $this->randomEventType(),
                'athlete_name' => 'Athlete ' . $i,
                'description' => 'Achievement description for athlete ' . $i,
                'region_level' => $this->randomRegionLevel(),
                'rank' => $this->randomRank(),
                'certificate_date' => Carbon::create(rand(2015, now()->year), rand(1, 12), rand(1, 28))->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('achievements')->insert($data);
    }

    private function randomEventType()
    {
        $eventTypes = ['single-men', 'single-women', 'double-men', 'double-women', 'mixed-doubles','team'];
        return $eventTypes[array_rand($eventTypes)];
    }

    private function randomRegionLevel()
    {
        $levels = ['kabupaten', 'provinsi', 'nasional', 'internasional'];
        return $levels[array_rand($levels)];
    }

    private function randomRank()
    {
        $ranks = ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2'];
        return $ranks[array_rand($ranks)];
    }
}
