<?php

namespace App\Services\Content;

use App\Models\Artist;
use Illuminate\Http\UploadedFile;

class ArtistService {
    public function create(string $name, ?string $alternative_name, ?UploadedFile $coverFile) {
        $artist = new Artist();

        $artist->name = $name;
        $artist->alternative_name = $alternative_name;

        if($coverFile != null) {
            $artist->cover = $this->createCover($coverFile);
        }

        if($artist->save()) {
            return $artist;
        } else {
            return false;
        }
    }

    public function update(int $id, string $name, ?string $alternative_name, ?UploadedFile $coverFile) {
        $artist = Artist::findOrFail($id);

        $artist->name = $name;
        $artist->alternative_name = $alternative_name;

        if($coverFile != null) {
            $artist->cover = $this->createCover($coverFile);
        }

        return $artist->save();
    }

    public function destroy(int $id) {
        $artist = Artist::find($id);
        return $artist->delete();
    }

    public function createCover($file) {
        $coverSize = 256;

        $filePath = $file->getPathName();
        $fileType = $file->getMimeType();

        list($sourceWidth, $sourceHeight) = getimagesize($filePath);
        $thumbnailData = imagecreatetruecolor($coverSize, $coverSize);
        $sourceData = imagecreatefromstring(file_get_contents($filePath));
        imagecopyresampled($thumbnailData, $sourceData, 0, 0, 0, 0, $coverSize, $coverSize, $sourceWidth, $sourceHeight);

        ob_start();
        imagejpeg($thumbnailData);
        $finalData = ob_get_clean();

        return 'data:' . $fileType . ';base64,' . base64_encode($finalData);
    }
}
