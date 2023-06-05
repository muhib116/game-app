<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LanguageController extends Controller
{
    public function index() {
        $languages = Language::all();
        return Inertia::render('Backend/Language/index', compact('languages'));
    }

    public function all() {
        return Language::all();
    }

    public function store(Request $request) {
        $request->validate([
            'en' => 'required|unique:languages,en'
        ]);
        Language::create([
            'en' => $request->en,
            'no' => $request->no,
        ]);
        return redirect()->back()->with('success', 'Added successfully');
    }
}
