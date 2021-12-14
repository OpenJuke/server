<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserService;
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

    public function store(Request $request, UserService $userService)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = $userService->create($validated['name'], $validated['email'], $validated['password'], null);

        Auth::login($user);

        return Redirect::route('discovery.index');
    }
}
