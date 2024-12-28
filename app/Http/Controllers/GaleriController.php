<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the galleries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filter galleries berdasarkan query pencarian
        $galleries = Gallery::when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('sport_category', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        })
            ->orderBy('date', 'desc')
            ->paginate(4);

        return view('Galeri.daftar', ['galleries' => $galleries, 'search' => $search]);
    }

    /**
     * Show the form for creating a new gallery item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Galeri.tambah');
    }

    /**
     * Store a newly created gallery item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input fields
        $data = $request->validate([
            'title' => ['required', 'string'],
            'sport_category' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string'],
            'media_type' => ['required', 'in:photo,video'],
            'media_path' => ['nullable', 'file', 'mimes:jpeg,png,jpg,mp4,avi,mkv', 'max:20480'], // 20MB max size
        ]);

        // Check if a file is uploaded
        if ($request->hasFile('media_path')) {
            $file = $request->file('media_path');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $path = $file->storeAs('public/uploads/galleries', $filename); // Save to storage/app/public/uploads/galleries
            $data['media_path'] = str_replace('public/', 'storage/', $path); // Adjust path for public access
        }

        // Store data in the database
        Gallery::create($data);

        return redirect('/galleries')->with('message', 'Gallery item successfully created!');
    }


    /**
     * Display the specified gallery item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('Gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('Gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Validate input
        $data = $request->validate([
            'title' => ['required', 'string'],
            'sport_category' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string'],
            // 'media_type' => ['required', 'in:photo,video'],
            // 'media_path' => ['nullable', 'file', 'mimes:jpeg,png,jpg,mp4,avi,mkv', 'max:20480'], // Optional file
        ]);

        // Handle file upload
        // if ($request->hasFile('media_path')) {
        //     // Delete the old file if it exists
        //     if ($gallery->media_path) {
        //         Storage::delete(str_replace('storage/', 'public/', $gallery->media_path));
        //     }

        //     $file = $request->file('media_path');
        //     $filename = time() . '_' . Str::slug($file->getClientOriginalName());
        //     $path = $file->storeAs('public/uploads/galleries', $filename); // Save new file
        //     $data['media_path'] = str_replace('public/', 'storage/', $path); // Public path
        // } else {
        //     // Preserve the current media path if no new file is uploaded
        //     $data['media_path'] = $gallery->media_path;
        // }

        // Update gallery data
        $gallery->update($data);

        // Redirect with success message
        return redirect()->back()->with('message', 'Gallery item successfully updated!');
    }





    /**
     * Remove the specified gallery item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete the associated file if it exists
        if ($gallery->media_path) {
            Storage::delete(str_replace('storage/', 'public/', $gallery->media_path));
        }

        // Delete the gallery item
        $gallery->delete();

        return redirect()->back()->with('message', 'Gallery item successfully deleted!');
    }
    public function showPhoto(Request $request)
    {
        $search = $request->input('search');

        // Query pencarian berdasarkan nama atau cabang olahraga
        $galleries = Gallery::where('title', 'like', '%' . $search . '%')
            ->orWhere('sport_category', 'like', '%' . $search . '%')
            ->paginate(12);

        return view('viewpublik.Galeri.foto', compact('galleries', 'search'));
    }
}
