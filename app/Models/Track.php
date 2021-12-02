<?php

namespace App\Models;

use App\Models\User;
use App\Models\Playlist;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Track
 *
 * @property int $id
 * @property string $title
 * @property string|null $alternative_title
 * @property string|null $secondary_title
 * @property string|null $tags
 * @property int|null $duration
 * @property string|null $cover
 * @property string|null $asset_id
 * @property Album $album
 * @property User[] $users_who_liked
 * @property Playlist[] $playlists
 * @property Artist[] $artists
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $album_id
 * @property-read int|null $artists_count
 * @property-read int|null $playlists_count
 * @property-read int|null $users_who_liked_count
 * @method static \Illuminate\Database\Eloquent\Builder|Track newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track query()
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereAlternativeTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereSecondaryTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Track extends Model
{
    use HasFactory;

    public function users_who_liked()
    {
        return $this->belongsToMany(User::class, 'user_liked_track');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'track_artist');
    }
    
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
