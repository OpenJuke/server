<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Users/Index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function edit()
    {
        return Inertia::render('Admin/Users/Edit');
    }

    public function store(Request $request) {
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

        return Redirect::route('admin.users.index');
    }

    public function update(Request $request, $id) {
        // TODO
    }

    public function destroy(Request $request, $id) {
        // TODO
    }
}
