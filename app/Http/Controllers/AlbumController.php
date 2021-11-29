<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Album;

class AlbumController extends Controller
{
    public function show($id)
    {
        return Inertia::render('Albums/Show', [
            'album' => Album::with('artists', 'tracks')->find($id)
        ]);
    }
}
