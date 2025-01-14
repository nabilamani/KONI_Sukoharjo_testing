<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AchievementController extends Controller
{
    /**
     * Display a listing of the achievements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request

        // Filter data prestasi berdasarkan level user dan pencarian
        $achievements = Achievement::when($user->level === 'Admin', function ($query) {
            // Jika user adalah Admin, tampilkan semua data prestasi
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // Jika user bukan Admin, filter berdasarkan kategori olahraga yang dikelola user
                return $query->whereHas('sportCategory', function ($subQuery) use ($user) {
                    $subQuery->where('level', $user->level);
                });
            })
            ->when($search, function ($query) use ($search) {
                // Terapkan pencarian pada nama atlet dan kategori olahraga
                return $query->where(function ($query) use ($search) {
                    $query->where('athlete_name', 'like', "%$search%")
                        ->orWhereHas('sportCategory', function ($subQuery) use ($search) {
                            $subQuery->where('sport_category', 'like', "%$search%");
                        });
                });
            })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->paginate(4); // Display 4 items per page

        // Fetch achievement counts per sport category, rank, and region_level
        $categories = Achievement::select('sport_category', 'rank', DB::raw('COUNT(*) as total'))
            ->groupBy('sport_category', 'rank')
            ->get();

        // Transform data into a format suitable for the chart
        $chartData = $categories->groupBy('SportCategory.sport_category')->map(function ($item) {
            $ranks = [
                'Juara 1' => 0,
                'Juara 2' => 0,
                'Juara 3' => 0,
            ];

            foreach ($item as $entry) {
                $rank = $entry->rank;
                if (array_key_exists($rank, $ranks)) {
                    $ranks[$rank] = $entry->total;
                }
            }

            return $ranks;
        });

        // Fetch achievement counts per region_level for the pie chart
        $regionData = Achievement::select('region_level', DB::raw('COUNT(*) as total'))
            ->groupBy('region_level')
            ->get();

        $sportCategories = SportCategory::all();

        // Pass the regionData to the view for rendering the pie chart
        return view('Prestasi.daftar', [
            'achievements' => $achievements,
            'search' => $search,
            'chartData' => $chartData,
            'regionData' => $regionData,
            'sportCategories' => $sportCategories // Pass region-level data to the view
        ]);
    }





    /**
     * Show the form for creating a new achievement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('Prestasi.tambah', compact('sportCategories'));
    }

    /**
     * Store a newly created achievement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'event_type' => ['required', 'string'],
            'athlete_name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'region_level' => ['required', 'string'],
            'rank' => ['required', 'string'],
            'certificate_date' => ['required', 'date'],
        ]);

        $achievement = new Achievement;
        $data['id'] = $achievement->generateId();

        Achievement::create($data);

        return redirect('/achievements')->with('message', 'Achievement successfully created!');
    }

    /**
     * Display the specified achievement.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achievement = Achievement::findOrFail($id);
        return view('Achievement.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified achievement.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $achievement = Achievement::findOrFail($id);
        return view('Achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified achievement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'event_type' => ['required', 'string'],
            'athlete_name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'region_level' => ['required', 'string'],
            'rank' => ['required', 'string'],
            'certificate_date' => ['required', 'date'],
        ]);

        // Assign values from the request to the achievement model
        $achievement->sport_category = $request->sport_category;
        $achievement->event_type = $request->event_type;
        $achievement->athlete_name = $request->athlete_name;
        $achievement->description = $request->description;
        $achievement->region_level = $request->region_level;
        $achievement->rank = $request->rank;
        $achievement->certificate_date = $request->certificate_date;

        // Save the updated achievement data
        $achievement->save();

        return redirect()->back()->with('message', 'Achievement data successfully updated!');
    }

    /**
     * Remove the specified achievement from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return redirect()->back()->with('message', 'Achievement data successfully deleted!');
    }

    public function cetakPrestasi()
    {
        $user = Auth::user(); // Get the authenticated user

        // Filter achievements based on user level
        $achievements = Achievement::when($user->level !== 'Admin', function ($query) use ($user) {
            // Extract sport category from user level if not an Admin
            $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
            $query->where('sport_category', $sportCategory);
        })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->get(); // Retrieve all results based on filtering

        return view('Prestasi.cetak-prestasi', compact('achievements'));
    }
    public function showPrestasi(Request $request)
    {
        $search = $request->input('search');
        $achievements = Achievement::when($search, function ($query, $search) {
            $query->where('athlete_name', 'like', "%$search%")
                ->orWhere('sport_category', 'like', "%$search%");
        })->paginate(8);

        // Fetch achievement counts per sport category, rank, and region_level
        $categories = Achievement::select('sport_category', 'rank', DB::raw('COUNT(*) as total'))
            ->groupBy('sport_category', 'rank')
            ->get();

        // Transform data into a format suitable for the chart
        $chartData = $categories->groupBy('SportCategory.sport_category')->map(function ($item) {
            $ranks = [
                'Juara 1' => 0,
                'Juara 2' => 0,
                'Juara 3' => 0,
            ];

            // Fill the counts for each rank
            foreach ($item as $entry) {
                $rank = $entry->rank;
                if (array_key_exists($rank, $ranks)) {
                    $ranks[$rank] = $entry->total;
                }
            }

            return $ranks;
        });

        // Data for line chart
        $currentYear = now()->year; // Tahun sekarang
        $startYear = $currentYear - 9; // Tahun 10 tahun terakhir

        $lineChartData = Achievement::select(
            DB::raw('YEAR(certificate_date) as year'),
            'region_level',
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('certificate_date', '>=', $startYear) // Filter hanya untuk 10 tahun terakhir
            ->groupBy('year', 'region_level')
            ->get()
            ->groupBy('year') // Group by year for easier processing
            ->map(function ($item) {
                $regions = [
                    'Kabupaten' => 0,
                    'Provinsi' => 0,
                    'Nasional' => 0,
                    'Internasional' => 0,
                ];

                foreach ($item as $entry) {
                    $region = $entry->region_level;
                    if (array_key_exists($region, $regions)) {
                        $regions[$region] = $entry->total;
                    }
                }

                return $regions;
            });

        // Optional: Sort the results by year in descending order (if needed)
        $lineChartData = $lineChartData->sortKeysDesc();


        return view('viewpublik.Galeri.prestasi', compact('achievements', 'chartData', 'lineChartData'));
    }
}
