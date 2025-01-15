<?php

namespace App\Http\Controllers;

use App\Models\KoniStructures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KoniStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $konistructures = KoniStructures::when($user->level !== 'Admin', function ($query) use ($user) {
            // Add custom filtering based on user level if necessary
        })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('position', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('Koni.daftar', compact('konistructures', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Koni.tambah');
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'age' => 'required|integer',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/koni', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }


        KoniStructures::create($data);

        return redirect()->route('konistructures.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KoniStructures  $konistructure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'abc';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KoniStructures  $konistructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $konistructure = KoniStructures::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($konistructure->photo) {
                Storage::delete(str_replace('storage/', 'public/', $konistructure->photo));
            }

            // Upload new photo
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/koni', $filename);
            $data['photo'] = str_replace('public/', 'storage/', $path);
        }

        $konistructure->update($data);

        return redirect()->back()->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KoniStructures  $konistructure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konistructure = KoniStructures::findOrFail($id);

        if ($konistructure->photo) {
            Storage::delete(str_replace('storage/', 'public/', $konistructure->photo));
        }

        $konistructure->delete();

        return redirect()->back()->with('success', 'Anggota berhasil dihapus!');
    }

    public function cetakStructure()
    {
        $user = Auth::user(); // Get the authenticated user

        // Retrieve KONI structures based on user level
        $konistructures = KoniStructures::when($user->level !== 'Admin', function ($query) use ($user) {
            // Add filtering based on user level if necessary
            // Example: Filter by specific criteria if user is not Admin
        })
            ->orderBy('created_at', 'asc') // Sort results by creation date in ascending order
            ->get(); // Retrieve all results based on filtering

        return view('Koni.cetak-struktural', compact('konistructures'));
    }
    public function showstruktur()
    {
        // Ambil data terakhir berdasarkan created_at
        $lastStructure = KoniStructures::latest()->first();

        return view('viewpublik.profil.strukturalkoni', compact('lastStructure'));
    }
}
