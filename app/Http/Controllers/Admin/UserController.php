<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
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

    public function edit($id)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function store(Request $request, UserService $userService) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $userService->create($validated['name'], $validated['email'], $validated['password']);

        return Redirect::route('admin.users.index');
    }

    public function update(Request $request, UserService $userService, $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'string|nullable',
        ]);

        $userService->update($id, $validated['name'], $validated['email'], $validated['password']);

        return Redirect::route('admin.users.index');
    }

    public function destroy(Request $request, UserService $userService, $id) {
        $userService->destroy($id);

        return Redirect::route('admin.users.index');
    }
}
