<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data['files'] as $item) {
            $galery = new Gallery();
            $file = Storage::put('gallery', $item);
            $galery->advertisement_id = $data['advertisement_id'];
            $galery->path = $file;
            $galery->save();
        }
        return response("Imagens salvas", 200);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return response('Picture removed with Success!!!', 200);
    }
}
