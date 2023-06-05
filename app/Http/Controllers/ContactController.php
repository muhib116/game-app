<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index() {
        return Inertia::render('Backend/Contact/Index');
    }

    public function filter(Request $request) {
        $query = Contact::query();
        $limit = $request->limit ? $request->limit : 10;
        if ($request->type == 'seen') {
            $query->where('seen', 1);
        }
        if ($request->type == 'unseen') {
            $query->where('seen', 0);
        }
        // if ($request->start) {
        //     $query->whereDate('created_at', '>=', $request->start);
        // }
        // if ($request->end) {
        //     $query->whereDate('created_at', '<=', $request->end);
        // }
        $query->orderBy('created_at', 'desc');
        return $query->paginate($limit);
    }

    public function seen(Contact $contact) {
        $contact->update([
            'seen' => 1
        ]);
    }

    public function save(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'company' => 'required',
            'message' => 'required',
        ]);
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company' => $request->company,
            'message' => $request->message,
        ]);
        return redirect()->back()->with('success', 'Message send successfully');
    }
}
