<?php

namespace App\Services\Content;

use App\Models\Artist;
use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\UploadedFile;

class TrackService {
    public function create(string $title, ?string $alternative_title, ?string $secondary_title, ?string $tags, ?int $duration, ?UploadedFile $coverFile, ?UploadedFile $assetFile) {
        $track = new Track();

        $track->title = $title;
        $track->alternative_title = $alternative_title;
        $track->secondary_title = $secondary_title;
        $track->tags = $tags;
        $track->duration = $duration ?: 0;

        if($coverFile != null) {
            $track->cover = $this->createCover($coverFile);
        }

        // TODO: Upload file
        //$track->asset_id = $assetPath;

        if($track->save()) {
            return $track;
        } else {
            return false;
        }
    }

    public function update(int $id, string $title, ?string $alternative_title, ?string $secondary_title, ?string $tags, ?int $duration, ?UploadedFile $coverFile, ?UploadedFile $assetFile) {
        $track = Track::findOrFail($id);

        $track->title = $title;
        $track->alternative_title = $alternative_title;
        $track->secondary_title = $secondary_title;
        $track->tags = $tags;
        $track->duration = $duration ?: 0;

        if($coverFile != null) {
            $track->cover = $this->createCover($coverFile);
        }

        // TODO: Upload file
        $track->asset_id = $assetPath;

        return $track->save();
    }

    public function destroy(int $id) {
        $track = Track::findOrFail($id);

        // TODO: Delete Asset

        return $track->delete();
    }

    public function addArtist(int $id, int $artistId) {
        $track = Album::findOrFail($id);
        $artist = Artist::findOrFail($artistId);

        return $track->artists()->save($artist);
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
