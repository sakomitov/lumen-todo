<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/25/17
 * Time: 1:11 PM
 */

namespace App\Http\Controllers;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;




class NoteController extends ExampleController
{
    public function __construct()
    {
        $this->middleware('checktoken');
        $user = Auth::user();
    }


    public function index(){
        //get all the notes
        $notes = Note::all();
        //return array of notes
        return response()->json(['notes' => $notes], 200);
    }

    public function show($id) {
        //try to get the note with matching id
        $note = Note::where('id', $id)->first();

        if(! $note) {
            return $this->respondNotFound('No such note exists!');
        } else {
            return response()->json($note, 200);
        }
    }

    public function store(Request $request)
    {
        //check required fields ot create a note
        if (!$request->has('title') or !$request->has('description'))
        {
            return $this->setStatusCode(400)
                ->respondWithError('Parameters failed verification. A to-do must have a title and description.');
        }
        //if it passes the requirements, make a new note
        $note = Note::create([
            'title' => $request->get('title'),
            'description'=> $request->get('description'),
            'completed'=> false
            //need to include the user id this belongs to
        ]);
        return response()->json($note['id'], 201);
    }


    public function update(Request $request, $id) {
        //try getting requested note
        $note = Note::where('id', $id)->first();

        if(! $note) {
            return $this->respondNotFound('No such note exists!');
        } else {
            $attrs =['title', 'description', 'completed'];//modify the attributes that are modifiable
            for($i=0; $i<3; $i++) {
                if ($request->has($attrs[$i])) {
                    $note[$attrs[$i]] = $request->get($attrs[$i]);
                }
            }
        }
        $note->save();
        return response()->json($note, 200);
    }

    public function destroy($id)
    {
        $note = Note::where('id', $id)->first();
        if (!$note) {
            return response()->json(['message' => "The note with id {$id} doesn't exist"], 404);
        }
        $note->delete();
        return redirect('/notes');
    }

}