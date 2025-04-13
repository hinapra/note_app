<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        // Get only notes for the authenticated user
        return response()->json($request->user()->notes);
    }
    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        return response()->json($note);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = $request->user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note, 201);
    }

    public function update(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note);
    }

    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }

}
