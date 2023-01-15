<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Utils;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use Utils;
    public function upload(Request $request) {
        if ($request->hasFile('image')) {
            $name = $request->file('image')->hashName();
            $request->file('image')->move(public_path('upload'), $name);
            return response([
                'status' => 'success',
                'path' => asset('/upload/'.$name),
            ]);
        }
        return response([
            'status' => 'error',
            'path' => null
        ]);
    }

    public function delete(Request $request) {
        if ($request->path && file_exists(public_path('/upload/'.basename($request->path)))) {
            unlink(public_path('/upload/'.basename($request->path)));
        }
    }
}
