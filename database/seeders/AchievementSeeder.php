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
        $startYear = 2015; // Tahun awal
        $currentYear = now()->year;

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $kabupatenCount = rand(10, 15) + ($year - $startYear) * 2; // Kabupaten meningkat tiap tahun
            $provinsiCount = rand(5, 10) + ($year - $startYear); // Provinsi meningkat tiap tahun
            $nasionalCount = rand(3, 5) + intval(($year - $startYear) / 2); // Nasional meningkat perlahan
            $internasionalCount = rand(1, 2); // Internasional tetap rendah

            // Tambahkan data Kabupaten
            $data = array_merge($data, $this->generateAchievements($kabupatenCount, $year, 'Kabupaten'));

            // Tambahkan data Provinsi
            $data = array_merge($data, $this->generateAchievements($provinsiCount, $year, 'Provinsi'));

            // Tambahkan data Nasional
            $data = array_merge($data, $this->generateAchievements($nasionalCount, $year, 'Nasional'));

            // Tambahkan data Internasional
            $data = array_merge($data, $this->generateAchievements($internasionalCount, $year, 'Internasional'));
        }

        DB::table('achievements')->insert($data);
    }

    private function generateAchievements($count, $year, $regionLevel)
    {
        $achievements = [];
        for ($i = 0; $i < $count; $i++) {
            $achievements[] = [
                'id' => Str::uuid()->toString(),
                'sport_category' => rand(1, 4), // Pastikan id kategori olahraga ada di tabel sport_categories
                'event_type' => $this->randomEventType(),
                'athlete_name' => 'Athlete ' . Str::random(5),
                'description' => 'Achievement description for athlete ' . Str::random(5),
                'region_level' => $regionLevel,
                'rank' => $this->randomRank(),
                'certificate_date' => Carbon::create($year, rand(1, 12), rand(1, 28))->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $achievements;
    }

    private function randomEventType()
    {
        $eventTypes = ['single-men', 'single-women', 'double-men', 'double-women', 'mixed-doubles', 'team'];
        return $eventTypes[array_rand($eventTypes)];
    }

    private function randomRank()
    {
        $ranks = ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2'];
        return $ranks[array_rand($ranks)];
    }
}
