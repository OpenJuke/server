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
            'avatar' => 'file|nullable',
        ]);

        $avatar = null;
        if($request->file('avatar') != null) {
            $avatar = $this->createAvatar($request->file('avatar'));
        }

        $userService->create($validated['name'], $validated['email'], $validated['password'], $avatar);

        return Redirect::route('admin.users.index');
    }

    public function update(Request $request, UserService $userService, $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'string|nullable',
            'avatar' => 'file|nullable',
        ]);

        $avatar = null;
        if($request->file('avatar') != null) {
            $avatar = $this->createAvatar($request->file('avatar'));
        }

        $userService->update($id, $validated['name'], $validated['email'], $validated['password'], $avatar);

        return Redirect::route('admin.users.index');
    }

    public function destroy(Request $request, UserService $userService, $id) {
        $userService->destroy($id);

        return Redirect::route('admin.users.index');
    }

    public function createAvatar($file) {
        $avatarSize = 256;

        $filePath = $file->getPathName();
        $fileType = $file->getMimeType();

        list($sourceWidth, $sourceHeight) = getimagesize($filePath);
        $thumbnailData = imagecreatetruecolor($avatarSize, $avatarSize);
        $sourceData = imagecreatefromstring(file_get_contents($filePath));
        imagecopyresampled($thumbnailData, $sourceData, 0, 0, 0, 0, $avatarSize, $avatarSize, $sourceWidth, $sourceHeight);

        ob_start();
        imagejpeg($thumbnailData);
        $finalData = ob_get_clean();

        return 'data:' . $fileType . ';base64,' . base64_encode($finalData);
    }
}
