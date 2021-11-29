<?php

namespace App\Services\Content;

use App\Models\Artist;

class ArtistService {
    public function create(string $name, ?string $alternative_name, ?string $cover_base64) {
        $artist = new Artist();

        $artist->name = $name;
        $artist->alternative_name = $alternative_name;
        $artist->cover = $cover_base64;

        if($artist->save()) {
            return $artist;
        } else {
            return false;
        }
    }

    public function update(int $id, string $name, ?string $alternative_name, ?string $cover_base64) {
        $artist = Artist::find($id);

        $artist->name = $name;
        $artist->alternative_name = $alternative_name;
        $artist->cover = $cover_base64;

        return $artist->save();
    }

    public function destroy(int $id) {
        $artist = Artist::find($id);
        return $artist->delete();
    }
}
