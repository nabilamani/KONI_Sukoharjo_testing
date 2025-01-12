<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();  // Mendapatkan data pengguna yang sedang login
        $search = $request->input('search');

        // Filter schedules berdasarkan level pengguna dan query pencarian
        $schedules = Schedule::when($user->level !== 'Admin', function ($query) use ($user) {
            // Menghapus prefix "Pengurus Cabor " untuk mendapatkan kategori olahraga
            $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
            $query->where('sport_category', $sportCategory);
        })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('sport_category', 'like', "%$search%")
                        ->orWhere('venue_name', 'like', "%$search%");
                });
            })
            ->orderBy('date', 'asc')
            ->paginate(4);

        // Ambil semua kategori olahraga
        $sportCategories = SportCategory::all();

        return view('Jadwal.daftar', ['schedules' => $schedules, 'search' => $search, 'sportCategories' => $sportCategories,]);
    }


    /**
     * Show the form for creating a new schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('Jadwal.tambah', compact('sportCategories'));
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'sport_category' => ['required'],
            'venue_name' => ['required', 'string'],
            'venue_map' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($request->sport_category === 'all') {
            $data['sport_category'] = null; // Atur null jika "Semua"
        } else {
            $request->validate([
                'sport_category' => ['exists:sport_categories,id'],
            ]);
        }

        Schedule::create($data);

        return redirect('/schedules')->with('message', 'Schedule successfully created!');
    }

    /**
     * Display the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('Schedule.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('Schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string'],
            'date' => ['required', 'date'],
            'sport_category' => ['required'],
            'venue_name' => ['required', 'string'],
            'venue_map' => ['required', 'string'],
        ]);

        if ($request->sport_category === 'all') {
            $data['sport_category'] = null; // Atur null jika "Semua"
        } else {
            $request->validate([
                'sport_category' => ['exists:sport_categories,id'],
            ]);
        }

        $schedule->fill($data);
        $schedule->save();

        return redirect()->back()->with('message', 'Schedule data successfully updated!');
    }

    /**
     * Remove the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('message', 'Schedule data successfully deleted!');
    }
    public function showlatihan(Request $request)
    {
        $search = $request->input('search');

        // Query pencarian berdasarkan nama atau cabang olahraga
        $schedules = Schedule::where('name', 'like', '%' . $search . '%')
            ->orWhere('sport_category', 'like', '%' . $search . '%')
            ->paginate(12);

        return view('viewpublik.olahraga.latihan', compact('schedules', 'search'));
    }
}
