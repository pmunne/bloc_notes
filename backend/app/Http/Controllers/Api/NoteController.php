<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{

    public function index() 
    {
        return Note::all();
    }

    public function show(Note $note) 
    {
        return response()->json($note, 200);
    }

    public function store(Request $request) 
    {
        $data = $this->validateNote($request);
        $note = $this->createNote($data);

        return response()->json($note, 201);
    }

    public function update(Request $request, Note $note) 
    {
        $data = $this->validateNote($request, updating:true);
        $note->update($data);
        
        return response()->json($note, 200);
    }

    public function destroy(Note $note) 
    {
        $note->delete(); 
        return response()->json(null, 204);

    }

    private function validateNote(Request $request, bool $updating = false) 
    {
        return $request->validate([
            'title' => ($updating ? 'sometimes|': '') . 'required|string|max:255',
            'content' => ($updating ? 'sometimes|': '') . 'required|string',
        ]);

    }

    private function createNote(array $data)  
    {
        return Note::create($data);
    } 


}
