<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function SignUp()
    {
        return view('users.sign_up');
    }

    public function LogIn(Request $request)
    {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($formFields);

        if (auth()->attempt($formFields)) {

            $request->session()->regenerate();

            return redirect('/')->with('message', 'Sign in succeeded!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function LogOut(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function SignIn()
    {
        return view('users.sign_in');
    }

    public function Registration(Request $request)
    {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $formFields['first_name'] = trim($formFields['first_name']);
        $formFields['last_name'] = trim($formFields['last_name']);
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['role'] = 'user';

        $rules = ['email' => 'unique:users,email'];

        $validator = Validator::make($formFields, $rules);

        if ($validator->fails()) {
            return back()->withErrors(['email' => 'Invalid email'])->onlyInput('email');
        }

        $user = User::create($formFields);

        return redirect('/sign-in');

    }
}
