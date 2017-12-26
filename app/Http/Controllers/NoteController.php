<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/25/17
 * Time: 1:11 PM
 */

namespace App\Http\Controllers;
use App\Note;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;



class NoteController extends ExampleController
{
    public function index(){
        $notes = Note::all();
        return response()->json(['data' => $notes], 200);
    }

    public function show($id) {

        $note = Note::where('id', $id)->get();

        if(! $note) {
            return $this->respondNotFound('No such note exists!');
        } else {
            return response()->json($note, 200);
        }
    }

    public function store(Request $request)
    {

        if (!$request->has('title') or !$request->has('description'))
        {
            return $this->setStatusCode(400)
                ->respondWithError('Parameters failed verification. A to-do must have a title and description.');
        }
        Note::create([
            'title' => $request->get('title'),
            'description'=> $request->get('description'),
            'completed'=> false
            //need to include the user id this belongs to
        ]);
    }


}