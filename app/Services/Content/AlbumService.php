<?php

namespace App\Services\Content;

use App\Models\Artist;
use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\UploadedFile;

class AlbumService {
    public function create(string $title, ?string $alternative_title, ?UploadedFile $coverFile) {
        $album = new Album();

        $album->title = $title;
        $album->alternative_title = $alternative_title;

        if($coverFile != null) {
            $album->cover = $this->createCover($coverFile);
        }

        if($album->save()) {
            return $album;
        } else {
            return false;
        }
    }

    public function update(int $id, string $title, ?string $alternative_title, ?UploadedFile $coverFile) {
        $album = Album::findOrFail($id);

        $album->title = $title;
        $album->alternative_title = $alternative_title;

        if($coverFile != null) {
            $album->cover = $this->createCover($coverFile);
        }

        return $album->save();
    }

    public function destroy(int $id) {
        $album = Album::find($id);
        return $album->delete();
    }

    public function addArtist(int $id, int $artistId) {
        $album = Album::findOrFail($id);
        $artist = Artist::findOrFail($artistId);

        return $album->artists()->save($artist);
    }

    public function addTrack(int $id, int $trackId) {
        $album = Album::findOrFail($id);
        $track = Track::findOrFail($trackId);

        return $album->tracks()->save($track);
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
