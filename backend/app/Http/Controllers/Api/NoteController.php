<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{

    /**
     *  Returns a list of notes (6 per page).
     *  If finds a search input param, it filters by title.
     */
    public function index(Request $request) 
    {
        $finder = $request->input('search');
        $query = Note::query();

        if(!empty($finder)) {
           $query->where('title', 'like', "%{$finder}%");

        }
        return response()->json(
            $query->latest()->paginate(6)
        );

    }

    /**
     * Returns one specific note.
     */
    public function show(Note $note) 
    {
        return response()->json($note, 200);
    }

    /**
     * Stores a new Note.
     * Requires: title = "string(255)" and content=text.
     */
    public function store(Request $request) 
    {
        $data = $this->validateNote($request);
        $note = $this->createNote($data);

        return response()->json($note, 201);
    }

    /**
     * Update an existing note
     */
    public function update(Request $request, Note $note) 
    {
        $data = $this->validateNote($request, updating:true);
        $note->update($data);
        
        return response()->json($note, 200);
    }

    /**
     * Deletes an existing note.
     */
    public function destroy(Note $note) 
    {
        $note->delete(); 
        return response()->json(null, 204);

    }

    /**
     * Validate the input data. 
     * If updating is true, allows partial updates. 
     */
    private function validateNote(Request $request, bool $updating = false) 
    {
        return $request->validate([
            'title' => ($updating ? 'sometimes|': '') . 'required|string|max:255',
            'content' => ($updating ? 'sometimes|': '') . 'required|string',
        ]);

    }

    /**
     * Create a note from the validated data.
     */
    private function createNote(array $data)  
    {
        return Note::create($data);
    } 


}
