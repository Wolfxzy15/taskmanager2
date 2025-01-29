<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request){
        $incomingFields = $request->validate([
            'lusername' =>'required',
            'lpassword'=>'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['lusername'], 'password' => $incomingFields['lpassword']])){
            $request->session()->regenerate();
        }

        return redirect( ('/'));
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'password' => 'required'
        ]);

            User::create($incomingFields);
            return redirect('/');
    }
}
