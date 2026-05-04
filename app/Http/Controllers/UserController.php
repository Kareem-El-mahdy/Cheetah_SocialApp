<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function login(){
        return view('auth.login' , data: [
            "location" => "login"
        ]);
    }
    public function register(){
        return view('auth.register', data: [
            "location" => "register"
        ]);
    }
    public function authenticate(Request $request){
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not exceed 255 characters',
            'password.required' => 'Password is required',
            'password.max' => 'Password must not exceed 255 characters',
        ]);
        if(Auth::attempt($data)){
            $user = User::where('email', $data['email'])->first();
            return redirect()->route('posts.index')->with('success', 'Logged in successfully');
        }else{
            return back()->withErrors(['email' => 'Invalid credentials' , 'password' => 'Invalid credentials'])->withInput();
        }

    }
    public function storeUser(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|confirmed',
            'password_confirmation' => 'required|max:255|same:password',
        ],[
            'name.required' => 'Name is required',
            'name.max' => 'Name must not exceed 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not exceed 255 characters',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.max' => 'Password must not exceed 255 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('posts.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }


    
}
