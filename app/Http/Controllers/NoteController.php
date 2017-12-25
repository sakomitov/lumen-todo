<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/25/17
 * Time: 1:11 PM
 */

namespace App\Http\Controllers;
use App\Note;


class NoteController extends ExampleController
{
    public function index(){
        $notes = Note::all();
        return response()->json(['data' => $notes], 200);
    }

    public function show($id) {

        $note = Note::find($id);

        if(! $note) {
            return $this->respondNotFound('No such note exists!');
        } else {
            return response()->json([$note]);
        }
    }

}