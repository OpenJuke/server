<?php

namespace App\Services\Content;

use App\Models\Album;

class AlbumService {
    public function create(string $title, ?string $alternative_title, ?string $cover_base64 = null) {
        $album = new Album();

        $album->title = $title;
        $album->alternative_title = $alternative_title;
        $album->cover = $cover_base64;

        if($album->save()) {
            return $album;
        } else {
            return false;
        }
    }

    public function update(int $id, string $title, ?string $alternative_title, ?string $cover_base64 = null) {
        $album = Album::findOrFail($id);

        $album->title = $title;
        $album->alternative_title = $alternative_title;
        $album->cover = $cover_base64;

        return $album->save();
    }

    public function destroy(int $id) {
        $album = Album::find($id);
        return $album->delete();
    }
}
