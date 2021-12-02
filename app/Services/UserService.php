<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UserService {
    public function create(string $name, string $email, string $password, ?UploadedFile $avatarFile) {
        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if($avatarFile != null) {
            $user->avatar = $this->createAvatar($avatarFile);
        }

        if($user->save()) {
            return $user;
        } else {
            return false;
        }
    }

    public function update(int $id, string $name, string $email, ?string $password, ?UploadedFile $avatarFile) {
        $user = User::findOrFail($id);

        $user->name = $name;
        $user->email = $email;

        if($password) {
            $user->password = $password;
        }

        if($avatarFile != null) {
            $user->avatar = $this->createAvatar($avatarFile);
        }

        return $user->save();
    }

    public function destroy(int $id) {
        $user = User::find($id);
        return $user->delete();
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
