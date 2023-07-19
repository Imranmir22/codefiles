<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

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
            'password'=>'required |min:6 ',
            'profile' =>'nullable|sometimes|dimensions:max_width=400,max_height=400'
        ],
        ['profile.dimensions'=>'profile image size should be 400 x 400']
    );
        if($request->has('profile'))
        {
            $file = $request->profile;
            $path = $file->move('uploads',uniqid().".".$file->getClientOriginalExtension());
        }
        $user = User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'profile' => $path ?? null
            ]
        );
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
        $users = User::paginate(30); 
        return view('dashboard',compact('users'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function countWords()
    {
        $str = "Lorem ipsum dolor sit amet 'consectetur adipiscing' elit, litora 'enim cum tellus' nisl 'ridiculus senectus' natoque, 'eros' vestibulum mauris aenean tempus lobortis. Accumsan 'volutpat semper auctor' tincidunt";
            $i=0;
            $strSize=0;
            while($str[$i] ?? null)
            {
            $strSize++; 
            $i++;
            }   
            $words=0;
            $flag = 0 ;
          for( $i = 0 ; $i < $strSize ; $i++)
          {
            if($str[$i+1] ?? null)
            {
                
                if($str[$i+1]=="'")
                {
                    if($flag==1)
                    {
                        $words++;
                        $flag=0;
                        $i=$i+2;
                    }else
                    {
                        $i++;
                        $words++;
                        $flag=1;
                    }
                }
                else if($str[$i]==" ")
                {
                    if($flag!=1)
                        $words++;
                }
            }else{
                $words++;
            }
          }
        echo "the number of words in your string are " .$words;
    }
}
