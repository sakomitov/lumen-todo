<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/26/17
 * Time: 10:32 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends ExampleController
{
    public function store(Request $request){
        //check required fields to log in
        if (!$request->has('username') or !$request->has('password'))
        {
            return $this->setStatusCode(400)
                ->respondWithError('You must provide a username and password.');
        }
        //try finding a user by the given name
        $user = User::where('username', $request->get('username'))->first();

        //check password if user is present
        if (!$user){
            return $this->setStatusCode(400)
                ->respondWithError('No such user found. Please register.');
        } else {
            if ($user['password'] == $request->get('password')) {
                $apitoken = str_random(32);

                User::where('username', $request->input('username'))->update(['api_token' => "$apitoken"]);
                return response()->json($apitoken, 201);

            } else {
                return $this->setStatusCode(400)
                    ->respondWithError('Wrong password.');
            }
        }
    }

    public function destroy(Request $request) {
        $user = Auth::user();
        if (! $user) {
            return response()->json(["error" => "You must be logged in to log out!"], 400);
        } else {
            $shuffled_token = str_shuffle(Auth::user()->api_token);
            Auth::user()->update(['api_token' => $shuffled_token]);
            return $shuffled_token;
        }
    }
}