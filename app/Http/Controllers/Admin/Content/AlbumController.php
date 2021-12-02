<?php

namespace App\Http\Controllers\Admin\Content;

use App\Services\Content\AlbumService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Artist;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Content/Albums/Index', [
            'albums' => Album::with('artists', 'tracks')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Content/Albums/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Admin/Content/Albums/Edit', [
            'album' => Album::with('artists', 'tracks', 'tracks.artists')->findOrFail($id),
            'artists' => Artist::all(),
            'tracks' => Track::all()
        ]);
    }

    public function store(Request $request, AlbumService $albumService) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $albumService->create(
            $validated['title'],
            $validated['alternative_title'],
            $request->file('cover')
        );

        return Redirect::route('admin.content.albums.index');
    }

    public function update(Request $request, AlbumService $albumService, $id) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $albumService->update(
            $id,
            $validated['title'],
            $validated['alternative_title'],
            $request->file('cover')
        );

        return Redirect::route('admin.content.albums.index');
    }

    public function destroy(Request $request, AlbumService $albumService, $id) {
        $albumService->destroy($id);

        return Redirect::route('admin.content.albums.index');
    }
}
