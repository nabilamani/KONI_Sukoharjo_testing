<?php

namespace App\Http\Controllers;

use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SportCategoryController extends Controller
{
    // Tampilkan daftar sport categories
    public function index(Request $request)
    {
        $search = $request->input('search');
        $SportCategories = SportCategory::when($search, function ($query) use ($search) {
                $query->where('nama_cabor', 'like', "%$search%")
                      ->orWhere('puslatcab', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('cabor.daftar', compact('SportCategories', 'search'));
    }

    // Form tambah sport category
    public function create()
    {
        return view('cabor.tambah');
    }

    // Menyimpan sport category
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_cabor' => 'required|string|unique:sport_categories',
            'sport_category' => 'required|string',
            'deskripsi' => 'nullable|string',
            'puslatcab' => 'nullable|string',
            'kontak' => 'nullable|string|max:100',
            'level' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/sport_categories', $filename);
            $data['logo'] = str_replace('public/', 'storage/', $path);
        }

        // Simpan data
        SportCategory::create($data);

        return redirect()->route('sportcategories.index')->with('message', 'Cabang Olahraga berhasil ditambahkan!');
    }

    // Edit sport category
    public function edit($id)
    {
        $category = SportCategory::findOrFail($id);
        return view('cabor.edit', compact('SportCategory'));
    }

    // Update sport category
    public function update(Request $request, $id)
    {
        $category = SportCategory::findOrFail($id);

        $data = $request->validate([
            'nama_cabor' => 'required|string|unique:sport_categories,nama_cabor,' . $id,
            'sport_category' => 'required|string',
            'deskripsi' => 'nullable|string',
            'puslatcab' => 'nullable|string',
            'kontak' => 'nullable|string|max:100',
            'level' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update file logo jika diunggah ulang
        if ($request->hasFile('logo')) {
            if ($category->logo) {
                Storage::delete(str_replace('storage/', 'public/', $category->logo));
            }
            $file = $request->file('logo');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/img/sport_categories', $filename);
            $data['logo'] = str_replace('public/', 'storage/', $path);
        }

        $category->update($data);

        return redirect()->back()->with('message', 'Cabang Olahraga berhasil diperbarui!');
    }

    // Hapus sport category
    public function destroy($id)
    {
        $category = SportCategory::findOrFail($id);

        if ($category->logo) {
            Storage::delete(str_replace('storage/', 'public/', $category->logo));
        }

        $category->delete();

        return redirect()->back()->with('message', 'Cabang Olahraga berhasil dihapus!');
    }
}
