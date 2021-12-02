<?php

namespace App\Http\Controllers\Admin\Content;

use App\Services\Content\ArtistService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Content/Artists/Index', [
            'artists' => Artist::with('tracks', 'albums')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Content/Artists/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Admin/Content/Artists/Edit', [
            'artist' => Artist::findOrFail($id)
        ]);
    }

    public function store(Request $request, ArtistService $artistService) {
        $validated = $request->validate([
            'name' => 'required|string',
            'alternative_name' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $artistService->create(
            $validated['name'],
            $validated['alternative_name'],
            $request->file('cover')
        );

        return Redirect::route('admin.content.artists.index');
    }

    public function update(Request $request, ArtistService $artistService, $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'alternative_name' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $artistService->update(
            $id,
            $validated['name'],
            $validated['alternative_name'],
            $request->file('cover')
        );

        return Redirect::route('admin.content.artists.index');
    }

    public function destroy(Request $request, ArtistService $artistService, $id) {
        $artistService->destroy($id);

        return Redirect::route('admin.content.artists.index');
    }
}
