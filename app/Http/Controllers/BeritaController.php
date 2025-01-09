<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of the news articles.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request

        // Filter news articles based on user level and search query if provided
        $beritas = Berita::when($user->level === 'Admin', function ($query) {
            // If the user is an Admin, return all news articles
            return $query;
        })
            ->when($user->level !== 'Admin', function ($query) use ($user) {
                // If the user is not an Admin, filter news by the sport category the user manages
                return $query->whereHas('sportCategory', function ($subQuery) use ($user) {
                    $subQuery->where('id', $user->sport_category); // Assuming user has sport_category_id
                });
            })
            ->when($search, function ($query) use ($search) {
                // Apply search filter on title, location, and sport category
                return $query->where('judul_berita', 'like', "%$search%")
                    ->orWhere('lokasi_peristiwa', 'like', "%$search%")
                    ->orWhereHas('sportCategory', function ($subQuery) use ($search) {
                        $subQuery->where('sport_category', 'like', "%$search%");
                    });
            })
            ->orderBy('tanggal_waktu', 'desc') // Sort results by date in descending order
            ->paginate(4); // Display 4 items per page

        // Ambil semua kategori olahraga
        $sportCategories = SportCategory::all();

        return view('berita.daftar', [
            'beritas' => $beritas,
            'search' => $search,
            'sportCategories' => $sportCategories,
        ]);
    }


    /**
     * Show the form for creating a new news article.
     */
    public function create()
    {
        $sportCategories = SportCategory::all();
        return view('berita.tambah', compact('sportCategories'));
    }

    /**
     * Store a newly created news article in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'judul_berita' => 'required|string',
            'sport_category' => ['required'],
            'tanggal_waktu' => 'required|date',
            'lokasi_peristiwa' => 'required|string',
            'isi_berita' => 'required',
            'kutipan_sumber' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->sport_category === 'all') {
            $data['sport_category'] = null; // Atur null jika "Semua"
        } else {
            $request->validate([
                'sport_category' => ['exists:sport_categories,id'],
            ]);
        }

        $data['tanggal_waktu'] = Carbon::parse($request->tanggal_waktu);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/img/berita', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        $berita = new Berita;
        $data['id'] = $berita->generateId(); // Generate and assign the custom ID
        $berita->fill($data); // Fill the model with the validated data


        Berita::create($data);

        return redirect('/beritas')->with('message', 'News article successfully created!');
    }

    /**
     * Display the specified news article.
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified news article.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified news article in storage.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $data = $request->validate([
            'judul_berita' => 'required|string',
            'sport_category' => ['required'],
            'tanggal_waktu' => 'required|date',
            'lokasi_peristiwa' => 'required|string',
            'isi_berita' => 'required',
            'kutipan_sumber' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->sport_category === 'all') {
            $data['sport_category'] = null; // Atur null jika "Semua"
        } else {
            $request->validate([
                'sport_category' => ['exists:sport_categories,id'],
            ]);
        }

        $data['tanggal_waktu'] = Carbon::parse($request->tanggal_waktu);

        if ($request->hasFile('photo')) {
            if ($berita->photo) {
                Storage::delete(str_replace('storage/', 'public/', $berita->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/img/berita', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        $berita->update($data);
        $berita = Berita::findOrFail($id);

        return redirect()->back()->with('message', 'News article successfully updated!');
    }

    /**
     * Remove the specified news article from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->photo) {
            Storage::delete(str_replace('storage/', 'public/', $berita->photo));
        }

        $berita->delete();

        return redirect()->back()->with('message', 'News article successfully deleted!');
    }

    public function publik(Request $request)
    {
        // Ambil kata kunci pencarian dari query string
        $search = $request->input('search');

        // Jika ada kata kunci pencarian, cari berita yang sesuai
        if ($search) {
            $beritaUtama = Berita::where('judul_berita', 'like', '%' . $search . '%')
                ->orWhere('lokasi_peristiwa', 'like', '%' . $search . '%')
                ->orderBy('tanggal_waktu', 'desc')
                ->first();

            $beritaLatepost = Berita::where('judul_berita', 'like', '%' . $search . '%')
                ->orWhere('lokasi_peristiwa', 'like', '%' . $search . '%')
                ->orderBy('tanggal_waktu', 'desc')
                ->skip(1)
                ->take(4)
                ->get();
        } else {
            // Ambil berita utama sebagai "Berita Utama" (misalnya 1 artikel terbaru)
            $beritaUtama = Berita::orderBy('tanggal_waktu', 'desc')->first();

            // Ambil berita lainnya sebagai "Berita Latepost" (dikecualikan berita utama)
            $beritaLatepost = Berita::orderBy('tanggal_waktu', 'desc')
                ->skip(1) // Lewati berita utama yang sudah diambil
                ->take(4) // Ambil 4 berita berikutnya
                ->get();
        }

        // Ambil event mendatang (future events) yang tanggal_event > sekarang
        $upcomingEvents = Event::where('event_date', '>=', now()->startOfDay())
            ->orderBy('event_date', 'asc') // Urutkan berdasarkan tanggal event
            ->take(4) // Ambil 4 event mendatang
            ->get();

        // Kirim data ke view
        return view('viewpublik.berita.home', compact('beritaUtama', 'beritaLatepost', 'upcomingEvents', 'search'));
    }


    public function daftarberita(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search'); // Capture the search input from the request
        $categoryId = $request->input('category_id'); // Capture category filter

        // Filter berita berdasarkan pencarian dan kategori
        $beritas = Berita::with('sportCategory') // Include sportCategory relation
            ->when($search, function ($query) use ($search) {
                $query->where('judul_berita', 'like', "%$search%")
                    ->orWhere('lokasi_peristiwa', 'like', "%$search%");
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('sport_category', $categoryId); // Filter by sport_category
            })
            ->orderBy('tanggal_waktu', 'desc') // Sort by date descending
            ->paginate(4); // Paginate the results

        // Ambil event mendatang (future events)
        $upcomingEvents = Event::where('event_date', '>=', now()->startOfDay())
            ->orderBy('event_date', 'asc')
            ->take(4)
            ->get();

        // Ambil daftar kategori hanya dari Berita
        $categories = Berita::select('sport_category')
            ->distinct()
            ->with('sportCategory') // Include related category name
            ->get();

        return view('viewpublik.berita.daftar', compact('beritas', 'search', 'upcomingEvents', 'categories', 'categoryId'));
    }


    public function detail(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $categoryId = $request->input('category_id'); // Capture category filter

        // Filter berita berdasarkan pencarian dan kategori
        $beritas = Berita::with('sportCategory') // Include sportCategory relation
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('sport_category', $categoryId); // Filter by sport_category
            })
            ->orderBy('tanggal_waktu', 'desc') // Sort by date descending
            ->paginate(4);

        // Ambil event mendatang (future events) yang tanggal_event > sekarang
        $upcomingEvents = Event::where('event_date', '>=', now()->startOfDay()) // Menyertakan hari ini
            ->orderBy('event_date', 'asc') // Urutkan berdasarkan tanggal event
            ->take(4) // Ambil 4 event mendatang
            ->get();

        // Ambil daftar kategori hanya dari Berita
        $categories = Berita::select('sport_category')
            ->distinct()
            ->with('sportCategory') // Include related category name
            ->get();


        return view('viewpublik.berita.detail', compact('berita', 'upcomingEvents', 'categories', 'categoryId'));
    }
}
