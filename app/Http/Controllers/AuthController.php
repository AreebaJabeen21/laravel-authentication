<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request){
        $request -> validate([
            'name'=> 'nullable|max:100|regex:/^[-a-zA-Z&\s\x80-\xFF]*$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect('/');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with('toast_error', trans('The provided credentials do not match our records.'));
        }

        $role = $user->role;

        if ($user->trashed()) {
            return back()->with('toast_info', trans('Your account is deactivated'));
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/');
    }
}
