<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Website;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'email |unique:users|required',
            'password'=>'required |min:6|confirmed ',
        ],
    );
       
        $user = User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
            ]
        );
        auth()->login($user);
        return redirect()->to('/gallery');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginUSer(Request $request)
    {
        $request->validate([
            'email'=>'email|exists:users|required',
            'password'=>'required|min:6'
        ]);
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->with([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        
        return redirect()->to('/gallery');
    }
    public function dashboard()
    {
        
        $users =User::with('websites')->find(Auth::id());
        return view('user.gallery',compact('users'));
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
   
}
