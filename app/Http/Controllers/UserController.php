<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UserController extends Controller
{
    public function login(Request $request) {
        $email = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL);
        echo $email;
        $password = $request->input('password');
        $user = DB::table('users')->where('email', '=', $email)->first();
        if(!$user) {
            return redirect('login')->with('error', 'The user does not exist');
        }
    }
    public function register(Request $request) {
        $request->file('picture')->store('images'); die();
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'nickname' => $request->input('nickname'),
            'email' => $request->input('email'),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT)
        ]);
    }
}
