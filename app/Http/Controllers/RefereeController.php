<?php

namespace App\Http\Controllers;

use App\Models\Referee;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RefereeController extends Controller
{
    /**
     * Display a listing of the referees.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request

        // Filter referees based on user level and search query if provided
        $referees = Referee::when($user->level === 'Admin', function ($query) {
            // If the user is an Admin, return all referees
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // If the user is not an Admin, filter referees by the sport category the user manages
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
            ->paginate(4); // Display 4 items per page

        // Calculate referee count per sport category
        $categories = Referee::select('sport_category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('sport_category')
            ->with('sportCategory') // Use with() to load the related SportCategory name
            ->get();

        // Retrieve all sport categories
        $sportCategories = SportCategory::all();

        return view('Wasit.daftar', [
            'referees' => $referees,
            'search' => $search,
            'categories' => $categories,
            'sportCategories' => $sportCategories // Pass the categories data to the view
        ]);
    }


    /**
     * Show the form for creating a new referee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('Wasit.tambah', compact('sportCategories'));
    }

    /**
     * Store a newly created referee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'license' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $referee = new Referee;
        $data['id'] = $referee->generateId();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/referees', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        Referee::create($data);

        return redirect('/referees')->with('message', 'Referee successfully created!');
    }

    /**
     * Display the specified referee.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referee = Referee::findOrFail($id);
        return view('Wasit.show', compact('referee'));
    }

    /**
     * Show the form for editing the specified referee.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $referee = Referee::findOrFail($id);
        return view('Wasit.edit', compact('referee'));
    }

    /**
     * Update the specified referee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $referee = Referee::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string'],
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'license' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Update data from the request to the referee model
        $referee->fill($data);

        // Handle photo file if uploaded
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/referees', $filename);
            $referee->photo = str_replace('public/', 'storage/', $path);
        }

        $referee->save();

        return redirect()->back()->with('message', 'Referee data successfully updated!');
    }

    /**
     * Remove the specified referee from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referee = Referee::findOrFail($id);

        if ($referee->photo) {
            Storage::delete(str_replace('storage/', 'public/', $referee->photo));
        }

        $referee->delete();

        return redirect()->back()->with('message', 'Referee data successfully deleted!');
    }
    public function showReferees(Request $request)
    {
        $search = $request->input('search');

        // Query pencarian berdasarkan nama atau cabang olahraga
        $referees = Referee::where('name', 'like', '%' . $search . '%')
            ->orWhere('sport_category', 'like', '%' . $search . '%')
            ->paginate(12);

        return view('viewpublik.olahraga.wasit', compact('referees', 'search'));
    }
}
