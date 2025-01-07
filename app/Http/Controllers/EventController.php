<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $events = Event::when($user->level === 'Admin', function ($query) {
            // If the user is an Admin, return all events
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // If the user is not an Admin, filter events by the sport category the user manages
                // return $query->where('sport_category', $user->sport_category); // Use 'sport_category_id' instead of 'sport_category'
                return $query->whereHas('sportCategory', function ($subQuery) use ($user) {
                    $subQuery->where('level', $user->level);
                });
            })
            ->when($search, function ($query) use ($search) {
                // Apply search filter on name and sport category fields
                return $query->where('name', 'like', "%$search%")
                    ->orWhereHas('sportCategory', function ($subQuery) use ($search) {
                        $subQuery->where('sport_category', 'like', "%$search%");
                    });
            })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->paginate(4);

        // // Filter events based on user level and search query
        // $events = Event::when($user->level !== 'Admin', function ($query) use ($user) {
        //     $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
        //     $query->where('sport_category', $sportCategory);
        // })
        //     ->when($search, function ($query) use ($search) {
        //         $query->where('name', 'like', "%$search%")
        //             ->orWhere('sport_category', 'like', "%$search%")
        //             ->orWhere('location', 'like', "%$search%");
        //     })
        //     ->orderBy('created_at', 'asc')
        //     ->paginate(4);

        // Ambil semua kategori olahraga
        $sportCategories = SportCategory::all();

        return view('event.daftar', ['events' => $events, 'search' => $search, 'sportCategories' => $sportCategories]);
    }


    /**
     * Display a printable view of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetakEvent()
    {
        $user = Auth::user();

        $events = Event::when($user->level !== 'Admin', function ($query) use ($user) {
            $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
            $query->where('sport_category', $sportCategory);
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('event.cetak-event', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('event.tambah', compact('sportCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'location' => ['required', 'string'],
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Validasi banner
            'location_map' => ['required', 'string'], // Validasi iframe map lokasi
        ]);

        // Handle the banner image upload
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/events', $filename);
            $data['banner'] = str_replace('public/', 'storage/', $path); // Menyimpan path banner
        }


        // Generate ID and store event
        $event = new Event;
        $data['id'] = $event->generateId();
        Event::create($data);

        return redirect('/events')->with('message', 'Event berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.detail', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'location' => ['required', 'string'],
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Validasi banner
            'location_map' => ['required', 'string'], // Validasi URL map lokasi
        ]);

        // Handle the banner image upload
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/events', $filename);
            $data['banner'] = str_replace('public/', 'storage/', $path); // Menyimpan path banner
        }


        // Find and update the event
        $event = Event::findOrFail($id);
        $event->update($data);

        return redirect()->back()->with('message', 'Event berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->banner) {
            Storage::delete(str_replace('storage/', 'public/', $event->banner));
        }

        $event->delete();

        return redirect()->back()->with('message', 'Event berhasil dihapus');
    }
    public function showEvents(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $events = Event::query();

        // Filter berdasarkan nama atau kategori event
        if ($search) {
            $events->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sport_category', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan rentang tanggal
        if ($start_date && $end_date) {
            $events->whereBetween('event_date', [$start_date, $end_date]);
        } elseif ($start_date) {
            $events->where('event_date', '>=', $start_date);
        } elseif ($end_date) {
            $events->where('event_date', '<=', $end_date);
        }

        // Pagination
        $events = $events->paginate(8);

        return view('viewpublik.olahraga.event', compact('events', 'search', 'start_date', 'end_date'));
    }
    public function showCalender()
    {
        $events = Event::all(['id', 'name', 'event_date', 'location']);

        // Format data event untuk FullCalendar
        $calendarEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->event_date,
                'description' => $event->location, // Opsional untuk tooltip
            ];
        });

        return view('viewpublik.Galeri.calender', ['calendarEvents' => $calendarEvents]);
    }
}
