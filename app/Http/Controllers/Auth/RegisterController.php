<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $newUser = new User();
        $newUser->name = $validated['name'];
        $newUser->email = $validated['email'];
        $newUser->password = $validated['password'];
        $newUser->save();

        Auth::login($newUser);

        return Redirect::route('discovery.index');
    }
}
