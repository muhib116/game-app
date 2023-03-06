<?php

namespace App\Http\Controllers;

use App\Models\MediaLib;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    public function index() {
        $query = MediaLib::query();
        if (auth()->user()->type = 'gamehost') {
            $query->where('user_id', auth()->id());
        }
        $media = $query->get();
        return Inertia::render('Backend/Files/Index', [
            'files' => $media
        ]);
    }

    public function upload(Request $request) {
        if ($request->hasFile('image')) {
            $name = $request->file('image')->hashName();
            $request->file('image')->move(public_path('upload'), $name);
            $path = asset('/upload/'.$name);
            $data = MediaLib::create([
                'path' => $path,
                'user_id' => auth()->id()
            ]);
            return response([
                'status' => 'success',
                'data' => $data,
            ]);
        }

        return response([
            'status' => 'error',
            'data' => null
        ]);
    }

    public function delete(Request $request) {
        $media = MediaLib::find($request->id);
        if ($media) {
            if (file_exists(public_path('/upload/'.basename($media->path)))) {
                unlink(public_path('/upload/'.basename($media->path)));
            }
            $media->delete();
            return response([
                'status' => 'success',
                'data' => 'Delete successfully',
            ]);
        }
        
        return response([
            'status' => 'error',
            'data' => null
        ]);
    }
}
