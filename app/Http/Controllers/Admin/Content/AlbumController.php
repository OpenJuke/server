<?php

namespace App\Http\Controllers\Admin\Content;

use App\Services\Content\AlbumService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
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
            'album' => Album::findOrFail($id)
        ]);
    }

    public function store(Request $request, AlbumService $albumService) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $cover = null;
        if($request->file('cover') != null) {
            $cover = $this->createCover($request->file('cover'));
        }

        $albumService->create($validated['title'], $validated['alternative_title'], $cover);

        return Redirect::route('admin.content.albums.index');
    }

    public function update(Request $request, AlbumService $albumService, $id) {
        $validated = $request->validate([
            'title' => 'required|string',
            'alternative_title' => 'string|nullable',
            'cover' => 'file|nullable'
        ]);

        $cover = null;
        if($request->file('cover') != null) {
            $cover = $this->createCover($request->file('cover'));
        }

        $albumService->update($id, $validated['title'], $validated['alternative_title'], $cover);

        return Redirect::route('admin.content.albums.index');
    }

    public function destroy(Request $request, AlbumService $albumService, $id) {
        $albumService->destroy($id);

        return Redirect::route('admin.content.albums.index');
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
