<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class ImageUploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');

        $path = asset("/storage/images/" . $fileName);

        return response()->json(['location' => $path]);

    }
}
