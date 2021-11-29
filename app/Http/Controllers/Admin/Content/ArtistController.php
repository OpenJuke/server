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

        $cover = null;
        if($request->file('cover') != null) {
            $cover = $this->createCover($request->file('cover'));
        }

        $artistService->create($validated['name'], $validated['alternative_name'], $cover);

        return Redirect::route('admin.content.artists.index');
    }

    public function update(Request $request, ArtistService $artistService, $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'alternative_name' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $cover = null;
        if($request->file('cover') != null) {
            $cover = $this->createCover($request->file('cover'));
        }

        $artistService->update($id, $validated['name'], $validated['alternative_name'], $cover);

        return Redirect::route('admin.content.artists.index');
    }

    public function destroy(Request $request, ArtistService $artistService, $id) {
        $artistService->destroy($id);

        return Redirect::route('admin.content.artists.index');
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
