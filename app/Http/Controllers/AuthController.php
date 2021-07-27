<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|confirmed|min:5|max:30',
            'img' => 'nullable|image|max:1024|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('img')) {
            //add new img
            // $imgPath = Storage::put('users', $request->img);
            $imgPath = Storage::disk('uploads')->put('users', $request->img);
        } else {
            $imgPath = null;
        }

        // dd($imgPath);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'img' => $imgPath,
            'bio' => $request->bio,
            'password' => bcrypt($request->password)
        ]);
        Auth::login($user);
        return redirect(url("/profile/$user->id"));
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:30',
        ]);

        $isLogin = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if (!$isLogin) {
            $request->session()->flash('error_msg', "email or password is not valid");
            return back();
        }
        $user = User::where('email', '=', $request->email)->first();
        return redirect(url("/profile/$user->id"));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("user/editForm", ['user' => $user]);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // dd($user);

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'password' => 'required|string|confirmed|min:5|max:30',
            'img' => 'nullable|image|max:1024|mimes:jpg,png,jpeg'
        ]);

        $imgPath = $user->img;

        if ($request->hasFile('img')) {
            //delet old img
            unlink(public_path() . "/uploads/$imgPath");
            // Storage::delete($imgPath);
            //add new img
            $imgPath = Storage::disk('uploads')->put('users', $request->img);
        }

        $user->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
            'img' => $imgPath
        ]);

        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        // if (!$isLogin) {
        //     $request->session()->flash('error_msg', "email or password is not valid");
        //     return back();
        // }
        // $user = User::where('email', '=', $request->email)->first();
        return redirect(url("/profile/$user->id"));
    }


    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }
}