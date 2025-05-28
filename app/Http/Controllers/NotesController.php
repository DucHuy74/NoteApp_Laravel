<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index(Request $request) {
    $user = Auth::user();

    $query = Note::where('user_id', $user->id);

    if ($request->filled('search')) {
        $searchTerm = $request->search;

        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('tags', function($q2) use ($searchTerm) {
                  $q2->where('tagName', 'like', '%' . $searchTerm . '%');
              });
        });
    }

    $notes = $query->with('tags')->paginate(10);

    return view('notes.index', ['notes' => $notes]);
}

    public function note($id)
    {
        $user = Auth::user();
        $note = Note::where('id', $id)
                    ->where('user_id', $user->id)
                    ->with('tags')
                    ->firstOrFail();
        return view('notes.note', [
            'note' => $note
        ]);
    }

    public function create()
    {
        return view('notes.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'text' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $note = Note::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'user_id' => auth()->id(),
        ]);

        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->input('tags')));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['tagName' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
            $note->tags()->sync($tagIds);
        }

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $note = Note::where('id', $id)
                    ->where('user_id', $user->id)
                    ->with('tags')
                    ->firstOrFail();
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'text' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $user = Auth::user();
        $note = Note::where('id', $id)
                    ->where('user_id', $user->id)
                    ->firstOrFail();

        $note->title = $request->input('title');
        $note->text = $request->input('text');
        $note->save();

        $tagIds = [];
        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->input('tags')));
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['tagName' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
        }
        $note->tags()->sync($tagIds);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function delete($id)
    {
        $user = Auth::user();
        $note = Note::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
}