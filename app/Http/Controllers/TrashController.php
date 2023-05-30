<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashController extends Controller
{
    public function index()
    {
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(10);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view('notes.show')->with('note', $note);
    }

    public function update(Request $request, Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->restore();
        return to_route('notes.show', $note)->with('success', 'restored');
    }

    public function destroy(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->forceDelete();
        return to_route('trashed.index')->with('success', 'Deleted');
    }
}
