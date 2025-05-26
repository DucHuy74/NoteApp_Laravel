<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class NotesController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        
        $query = Note::where('user_id', $user->id);

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // tìm kiếm theo 'title' sử dụng 'like'
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }
        $notes = $query->with('tags')->paginate(10);

        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    public function note($id) {
        $user = Auth::user();
        $note = Note::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        return view('notes.note', [
            'note'=>$note
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $note = Note::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }

    public function edit($id)
    {
        $note = Note::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $note = Note::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $note->title = $request->input('title');
        $note->text = $request->input('text');
        $note->save();

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function create()
    {
        return view('notes.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        Note::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }
}