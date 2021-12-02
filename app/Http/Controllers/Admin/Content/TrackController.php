<?php

namespace App\Http\Controllers\Admin\Content;

use App\Services\Content\TrackService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Artist;
use App\Models\Album;

class TrackController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Content/Tracks/Index', [
            'tracks' => Track::with('album', 'artists')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Content/Tracks/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Admin/Content/Tracks/Edit', [
            'track' => Track::with('album', 'album.artists', 'artists')->findOrFail($id),
            'artists' => Artist::all(),
            'albums' => Album::all()
        ]);
    }

    public function store(Request $request, TrackService $trackService) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'secondary_title' => 'string|nullable',
            'tags' => 'string|nullable',
            'duration' => 'int|nullable',
            'cover' => 'file|nullable',
            'asset' => 'file|nullable'
        ]);

        $trackService->create(
            $validated['title'],
            $validated['alternative_title'],
            $validated['secondary_title'],
            $validated['tags'],
            $validated['duration'],
            $request->file('cover'),
            $request->file('asset')
        );

        return Redirect::route('admin.content.tracks.index');
    }

    public function update(Request $request, TrackService $trackService, $id) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'secondary_title' => 'string|nullable',
            'tags' => 'string|nullable',
            'duration' => 'int|nullable',
            'cover' => 'file|nullable',
            'asset' => 'file|nullable'
        ]);

        $trackService->update(
            $id,
            $validated['title'],
            $validated['alternative_title'],
            $validated['secondary_title'],
            $validated['tags'],
            $validated['duration'],
            $request->file('cover'),
            $request->file('asset')
        );

        return Redirect::route('admin.content.tracks.index');
    }

    public function destroy(Request $request, TrackService $trackService, $id) {
        $trackService->destroy($id);

        return Redirect::route('admin.content.tracks.index');
    }
}
