<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request

        // Filter coaches based on user level and search query if provided
        $coaches = Coach::when($user->level === 'Admin', function ($query) {
            // If the user is an Admin, return all coa$coaches
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // If the user is not an Admin, filter coaches by the sport category the user manages
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
            ->paginate(4); // Display 4 items per page

        // Calculate coach count per sport category
        $categories = Coach::select('sport_category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('sport_category')
            ->with('sportCategory') // Use with() to load the related SportCategory name
            ->get();

        // Ambil semua kategori olahraga
        $sportCategories = SportCategory::all();

        return view('Pelatih.daftar', [
            'coaches' => $coaches,
            'search' => $search,
            'categories' => $categories,
            'sportCategories' => $sportCategories // Pass the categories data to the view
        ]);
    }


    public function cetakPelatih()
    {
        $user = Auth::user(); // Get the authenticated user

        // Filter coaches based on user level
        $coaches = Coach::when($user->level !== 'Admin', function ($query) use ($user) {
            // Extract sport category from user level if not an Admin
            $sportCategory = str_replace('Pengurus Cabor ', '', $user->level);
            $query->where('sport_category', $sportCategory);
        })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->get(); // Retrieve all results based on filtering

        return view('Pelatih.cetak-pelatih', compact('coaches'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('layouts.tambah', compact('sportCategories'));
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
            'sport_category' => ['required', 'exists:sport_categories,id'], // Validasi ID sport_category
            'age' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'whatsapp' => ['required', 'string'],
            'instagram' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $coach = new Coach;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/coaches', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        Coach::create($data);

        return redirect('/coaches')->with('message', 'Pelatih berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return 'abc';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coach = Coach::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'sport_category' => 'required|exists:sport_categories,id',
            'age' => 'required|integer',
            'whatsapp' => 'required|string',
            'instagram' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($coach->photo) {
                Storage::delete(str_replace('storage/', 'public/', $coach->photo));
            }

            // Upload new photo
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/coaches', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        $coach->update($data);

        return redirect()->back()->with('message', 'Data Pelatih berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coach = Coach::findOrFail($id);

        if ($coach->photo) {
            Storage::delete(str_replace('storage/', 'public/', $coach->photo));
        }

        $coach->delete();

        return redirect()->back()->with('message', 'Data Pelatih berhasil dihapus!');
    }

    public function showCoaches(Request $request)
    {
        $search = $request->input('search');
        $sportCategory = $request->input('sport_category');

        $query = Coach::query();

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

        $coaches = $query->paginate(8);

        // Ambil semua kategori olahraga untuk dropdown filter
        $sportCategories = Coach::select('sport_category')->distinct()->pluck('sport_category');

        return view('viewpublik.olahraga.pelatih', compact('coaches', 'sportCategories'));
    }

    public function cariPelatih(Request $request)
    {
        $search = $request->input('search');
        $sportCategory = $request->input('sport_category');
        $activeView = $request->input('_view');

        $query = Coach::query();

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

        $coaches = $query->paginate(8)->withPath(url('/olahraga/pelatih'))->appends($request->except('page'));

        return view('viewpublik.olahraga.table_pelatih', compact('coaches', 'activeView'));
    }
}
