<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $messages = Message::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('message', 'like', "%$search%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);  // Paginate results with 10 per page

        return view('Pesan.daftar', compact('messages', 'search'));
    }

    public function create()
    {
        return view('viewpublik.kontak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create($request->all());

        // Kembalikan respons JSON untuk AJAX
        return response()->json(['success' => true, 'message' => 'Pesan Anda telah berhasil terkirim. Terima kasih! 😊']);
    }



    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $message->update($request->all());
        return redirect()->route('messages.index')->with('success', 'Pesan berhasil diperbarui!');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
    public function updateStatus(Request $request, Message $message)
{
    // Validate the input
    $request->validate(['is_read' => 'required|boolean']);
    
    // Update the message's status
    $message->update(['is_read' => $request->is_read]);

    // Return a JSON response
    return response()->json(['success' => true, 'message' => 'Status pesan berhasil diperbarui!']);
}



}
