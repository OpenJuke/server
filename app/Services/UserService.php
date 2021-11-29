<?php

namespace App\Services;

use App\Models\User;

class UserService {
    public function create(string $name, string $email, string $password, ?string $avatar_base64 = null) {
        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if($avatar_base64) {
            $user->avatar = $avatar_base64;
        }

        if($user->save()) {
            return $user;
        } else {
            return false;
        }
    }

    public function update(int $id, string $name, string $email, ?string $password, ?string $avatar_base64 = null) {
        $user = User::findOrFail($id);

        $user->name = $name;
        $user->email = $email;

        if($password) {
            $user->password = $password;
        }

        if($avatar_base64) {
            $user->avatar = $avatar_base64;
        }

        return $user->save();
    }

    public function destroy(int $id) {
        $user = User::find($id);
        return $user->delete();
    }
}
