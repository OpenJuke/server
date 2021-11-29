<?php

namespace App\Http\Controllers\Admin\Content;

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

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'alternative_name' => 'string',
        ]);

        $artist = new Artist();
        $artist->name = $validated['name'];
        $artist->alternative_name = $validated['alternative_name'];
        $artist->save();

        return Redirect::route('admin.content.artists.index');
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'alternative_name' => 'string',
        ]);

        $artist = Artist::find($id);
        $artist->name = $validated['name'];
        $artist->alternative_name = $validated['alternative_name'];
        $artist->save();

        return Redirect::route('admin.content.artists.index');
    }

    public function destroy(Request $request, $id) {
        $artist = Artist::find($id);
        $artist->delete();

        return Redirect::route('admin.content.artists.index');
    }
}
