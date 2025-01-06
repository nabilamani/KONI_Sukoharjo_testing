<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SportCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{

    public function create()
{
    $sportCategories = SportCategory::pluck('level', 'id'); // Ambil data level dan ID
    return view('Akun.tambah', compact('sportCategories'));
}
    // public function create()
    // {
    //     return view('Akun.tambah'); // Assuming a view named 'register'
    // }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'level' => 'required|exists:sport_categories,level',
            ]);
        } catch(\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('users.index')->with('message', 'User berhasil ditambahkan!');
    }

    public function index()
    {
        $users = User::paginate(10); // Menampilkan daftar pengguna dengan paginasi
        return view('Akun.daftar', compact('users'));
    }

    public function edit($id)
    {
        return 'abc'; // Assuming a view named 'edit'
    }

    public function update(Request $request, $id)
{
    // Temukan pengguna berdasarkan ID
    $user = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'level' => 'required|string',
    ]);

    try {
        // Perbarui data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'level' => $request->level,
        ]);

        return redirect()->back()->with('message', 'Akun berhasil diperbarui!');
    } catch (\Exception $e) {
        // Tangani jika terjadi error
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui akun.']);
    }
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'Akun berhasil dihapus!');
    }
}