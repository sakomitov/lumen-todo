<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/25/17
 * Time: 1:07 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    public function store(Request $request)
    {
        //check required fields ot create a user
        if (!$request->has('username') or !$request->has('password') or !$request->has('password_confirmation'))
        {
            return $this->setStatusCode(400)
                ->respondWithError('Please input a username, a pasword, and confirm the password.');
        }
        $user = User::where('username', '=', $request->get('username'))->first();
        if ($user === null) {
            if($request->get('password') == $request->get('password_confirmation')){
                $new_user = User::create([
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                    'api_token' => str_random(32)
                ]);

            } else {
                return response()->json(['error' => 'passwords do not match'], 400);
            }
        } else {
            return response()->json(['error'=> 'user with that username already exists'], 400);
        }
    }
}