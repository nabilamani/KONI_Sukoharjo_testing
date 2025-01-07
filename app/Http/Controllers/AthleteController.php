<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SportCategory;

class AthleteController extends Controller
{
    /**
     * Display a listing of the athletes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request

        // Filter athletes based on user level and search query if provided
        $athletes = Athlete::when($user->level === 'Admin', function ($query) {
            // If the user is an Admin, return all athletes
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // If the user is not an Admin, filter athletes by the sport category the user manages
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

        $categories = Athlete::select('sport_category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('sport_category')
            ->with('sportCategory') // Use with() to load the related SportCategory name
            ->get();

        // Ambil semua kategori olahraga
        $sportCategories = SportCategory::all();

        return view('atlet.daftar', [
            'athletes' => $athletes,
            'search' => $search,
            'categories' => $categories,
            'sportCategories' => $sportCategories // Pass the categories data to the view
        ]);
    }


    /**
     * Show the form for creating a new athlete.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('Atlet.tambah', compact('sportCategories'));
    }

    public function cetakAthlete()
    {
        $user = Auth::user(); // Get the authenticated user

        // Filter athletes based on user level
        $athletes = athlete::when($user->level !== 'Admin', function ($query) use ($user) {
            // Extract sport category from user level if not an Admin
            $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
            $query->where('sport_category', $sportCategory);
        })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->get(); // Retrieve all results based on filtering

        return view('atlet.cetak-atlet', compact('athletes'));
    }
    /**
     * Store a newly created athlete in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'sport_category' => ['required', 'exists:sport_categories,id'], // Validasi ID sport_category
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'achievements' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $athlete = new Athlete;
        $data['id'] = $athlete->generateId();


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/athletes', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        Athlete::create($data);

        return redirect('/athletes')->with('message', 'Atlet berhasil ditambahkan!');
    }

    /**
     * Display the specified athlete.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $athlete = Athlete::findOrFail($id);
        return view('Atlet.show', compact('athlete'));
    }

    /**
     * Show the form for editing the specified athlete.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'abc';
    }

    /**
     * Update the specified athlete in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'sport_category' => ['required', 'exists:sport_categories,id'],
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'achievements' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($athlete->photo) {
                Storage::delete(str_replace('storage/', 'public/', $athlete->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/athletes', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        $athlete->update($data);

        return redirect()->back()->with('message', 'Data Athlete berhasil diperbarui!');
    }



    /**
     * Remove the specified athlete from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $athlete = Athlete::findOrFail($id);

        if ($athlete->photo) {
            Storage::delete(str_replace('storage/', 'public/', $athlete->photo));
        }

        $athlete->delete();

        return redirect()->back()->with('message', 'Data Athlete berhasil dihapus!');
    }
    public function showAthletes(Request $request)
    {
        $search = $request->input('search');
        $sportCategory = $request->input('sport_category');

        $query = Athlete::query();

        if ($search) {
            $keywords = preg_split('/[\s,]+/', $search); // Memecah kata kunci berdasarkan spasi atau koma
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('name', 'like', "%$keyword%")
                        ->orWhere('sport_category', 'like', "%$keyword%");
                }
            });
        }

        if ($sportCategory) {
            $query->where('sport_category', $sportCategory);
        }

        $athletes = $query->paginate(8);

        // Hitung akumulasi atlet per cabang olahraga
        $categories = Athlete::select('sport_category')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN gender = 'Laki-laki' THEN 1 ELSE 0 END) as male_total")
            ->selectRaw("SUM(CASE WHEN gender = 'Perempuan' THEN 1 ELSE 0 END) as female_total")
            ->groupBy('sport_category')
            ->get();

        // Ambil semua kategori olahraga untuk dropdown filter
        $sportCategories = SportCategory::all();

        return view('viewpublik.olahraga.atlet', compact('athletes', 'categories', 'sportCategories'));
    }


    public function cariAtlet(Request $request)
    {
        $search = $request->input('search');
        $sportCategory = $request->input('sport_category');
        $activeView = $request->input('_view');

        $query = Athlete::query();

        $query->when($search, function ($query) use ($search) {
            // Pecah kata kunci berdasarkan spasi atau koma
            $keywords = preg_split('/[\s,]+/', $search); // Memecah kata kunci berdasarkan spasi atau koma
            
            // Buat query untuk mencari di nama atlet dan kategori olahraga
            return $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('name', 'like', "%$keyword%")
                      ->orWhereHas('sportCategory', function ($subQuery) use ($keyword) {
                          $subQuery->where('sport_category', 'like', "%$keyword%");
                      });
                }
            });
        });

        if ($sportCategory) {
            $query->where('sport_category', $sportCategory);
        }

        $athletes = $query->paginate(8)->withPath(url('/olahraga/atlet'))->appends($request->except('page'));

        return view('viewpublik.olahraga.table_atlet', compact('athletes', 'activeView'));
    }
}
