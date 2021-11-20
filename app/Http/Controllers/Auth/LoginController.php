<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function login()
    {
        $this->validate(request(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(request(['name', 'password'])) == false) {
            Session::flash('message', 'Wrong password'); 
            return Redirect::route('login');
        }

        return Redirect::route('discovery.index');
    }
}
