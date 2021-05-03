<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return redirect(route('login'))->withErrors([
                    'login' => 'Email or password is incorrect!'
                ])->withInput();
            }

            Auth::login($user);

            return redirect('/dashboard');
        }

        return view('auth/login');
    }

    public function register() {
        return view('auth/register');
    }

    public function store(Request $request) {

        $request->validate(
            [
                'name'=>'required|string|max:20',
                'email' => 'required|email|unique:users,email',

                'password' => 'required|alpha_num|min:6',


            ]
        );

        $dataArray = array(
            "name"  =>  $request->name,
            "email" =>  $request->email,
            "avatar" =>  $request->avatar,
            "password" =>  bcrypt( $request->password)

        );
         function avatar() {
             return view('avatar-upload');
           }

        $user = User::create($dataArray);
        if(!is_null($user)) {
            return back()->with("success", "Success! Registration completed");
        }

        else {
            return back()->with("failed", "Alert! Failed to register");
        }


                return redirect('/dashboard');

}

   }
