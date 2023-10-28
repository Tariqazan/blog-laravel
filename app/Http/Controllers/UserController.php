<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $incommingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users','name')],
            'email' => ['required', 'email', Rule::unique('users','name')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        $incommingFields['password'] = bcrypt($incommingFields['password']);
        $user = User::create($incommingFields);
        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request){
        $incommingFields = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        if (auth()->attempt(
            ['name'=>$incommingFields['name'],
            'password'=>$incommingFields['password']
        ])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
