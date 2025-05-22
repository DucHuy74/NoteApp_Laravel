<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class NotesController extends Controller
{
    public function index() {
        $user = Auth::user();
        $notes = Note::where('user_id', $user->id)->paginate(10);
        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    public function note($id) {
        $user = Auth::user();
        // Tìm note của user hiện tại, nếu không tìm được sẽ 404
        $note = Note::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        return view('notes.note', [
            'note'=>$note
        ]);
    }
}   