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
        $user->assignrole(2);
        auth()->login($user);
        return redirect()->to('/dashboard');
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
        
        return redirect()->to('/dashboard');
    }
    public function dashboard()
    {
        if(auth()->user()->hasRole('admin'))
        {
            $websites = Website::with('user')->get();
            return view('admin.dashboard',compact('websites'));
        }
        else{
            $users =User::with('websites')->find(Auth::id());
            return view('user.dashboard',compact('users'));
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
   
}
