<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //Show Register/Create From
    public function create()
    {
        return view('users.register');
    }

    //Create new User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);


        //Create User 
        $user = User::create($formFields);

        //Login
        Auth::login($user);

        //Redirect
        return redirect('/')->with('message', 'User Created and Logged in Successfully');
    }

    //Logout User
    public function logout(Request $request)
    {
        Auth::logout();

        //invalidate user session

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //Show Login form
    public function login()
    {
        return view('users.login');
    }

    //Login User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Logged in Successfully');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
