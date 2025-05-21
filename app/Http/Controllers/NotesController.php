<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Note;


class NotesController extends Controller
{
    public function index() {
        $notes = Note::paginate(10);
        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    public function note($id) {
        $note = Note::findOrFail($id); //tim theo id trong db tra ve Obj tuong ung, fail thi tra ve lỗi ModelNotFoundException (404)

        return view('notes.note', [
            'note'=>$note
        ]);
    }
}