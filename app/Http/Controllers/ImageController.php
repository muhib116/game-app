<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Utils;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    use Utils;
    public function upload(Request $request) {
        if ($request->hasFile('image')) {
            if ($request->type == 'loginSetup') {
                $image = $request->file('image');
                $img = Image::make($image);
                $file_name = 'upload/'.rand(10000,99999).time().'.webp';
                $img->fit(500, 700);
                $img->save($file_name, 90, 'webp');
                return response([
                    'status' => 'success',
                    'path' => asset($file_name),
                ]);
            } else {
                $name = $request->file('image')->hashName();
                $request->file('image')->move(public_path('upload'), $name);
                return response([
                    'status' => 'success',
                    'path' => asset('/upload/'.$name),
                ]);
            }
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
