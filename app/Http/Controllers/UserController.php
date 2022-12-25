<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\User;
use App\Models\Like;

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
        $auth = password_verify($password, $user->password);
        if(!$auth) {
            return redirect('login')->with('error', 'The password  or email are incorrect');
        }
        session(['identity' => $user]);
        return redirect('dashboard');
    }

    public function register(Request $request) {
        $path = $request->file('picture')->store('public/users'); 
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'nickname' => $request->input('nickname'),
            'email' => $request->input('email'),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
            'image_path' => $path,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $identity = DB::table('users')->where('email', '=', $request->input('email'))->first();

        session(['identity'=> $identity]);

        return redirect('dashboard');
    }

    public function close() {
        session()->forget('identity');
        session()->flush();
        return redirect('login');
    }

    public function profile($id) {
            $user = User::where('id', $id)->first();
            $path =  $user->image_path; 
            $profile_path =  Storage::url($path);

            $images = Image::where('user_id', $user->id)->get();
            $self_like = Like::where('user_id', session('identity')->id)->first();
           
            return view('user.profile', ['profile_path' => $profile_path, 'images' => $images, 'user_id' => $user->id, 'self_like' => $self_like]);
    }

    public function upload(Request $request) {
        $request->validate([
            'description' => 'string'
        ]);
        $image_path = $request->file('image')->store('public/images');

        DB::table('images')->insert([
            'user_id' => session('identity')->id,
            'image_path' => $image_path,
            'description' => $request->input('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s') 
        ]);
        return redirect('dashboard');
    }
    public function getSelfLike($image_id) {
        $selfLike = DB::table('likes')->where('image_id', $image_id)->where('user_id', session('identity')->id)->first();
        return $selfLike;
    }
    public function users() {
        $users = User::where('id', '<>', session('identity')->id)->get();
        return view('user.people', ['users' => $users]);
    }

    public function like($image_id) {

        if(!session('identity')) {
            return route('login');
        }
        $user = session('identity');
        
        $active = DB::table('likes')->join('users', 'user_id', '=', "users.id")->where('image_id', $image_id)->where('user_id', $user->id)->select('user_id')->first();  
        if($active) {
            DB::table('likes')->where('user_id', session('identity')->id)->where('image_id', $image_id)->delete();
            return redirect("post/$image_id");
        }
        DB::table('likes')->insert([
            'user_id' => session('identity')->id,
            'image_id' => $image_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect("post/$image_id");
    }

    public function favorites() {
        if(!session('identity')) {
            return route('login');
        }
        $favorites = Like::where('user_id', session('identity')->id)->get('image_id');
        return view('user.favorite', ['favorites' => $favorites]);
    }

    public function dashboard() {
        $images = Image::where('user_id', '<>',  session('identity')->id)->get();
        return view('user.dashboard', ['images' => $images]);
    }

    public function post($id) {
        $photo = Image::where('id', $id)->first();
        if(!$photo) {
            return redirect('dashboard');
        }
        return view('user.post', ['photo' => $photo]);
    }
}
