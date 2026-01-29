<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{

    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contact_messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->back()->with('success', 'Message deleted.');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'subject'  => 'nullable|string|max:255',
            'message'  => 'required|string',
            'phone'    => 'nullable|string|max:20',
            'web_url'  => 'nullable|url', 
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Message sent! We will contact you soon.');
    }
}

