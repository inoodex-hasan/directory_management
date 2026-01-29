<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{Category, ContactMessage};
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.pages.contact', compact('categories'));
    }

    /**
     * Generate a new captcha code
     */
    public function generateCaptcha()
    {
        // Generate a random 6-character alphanumeric code
        $captcha = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));
        
        // Store the captcha in session
        Session::put('captcha', $captcha);
        
        return response()->json([
            'captcha' => $captcha
        ]);
    }

    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'captcha' => 'required|string'
        ]);

        // Verify captcha
        if (strtoupper($request->captcha) !== Session::get('captcha')) {
            return back()
                ->withErrors(['captcha' => 'The captcha code you entered is incorrect.'])
                ->withInput();
        }

        // Clear the captcha from session after verification
        Session::forget('captcha');

        // Save the contact message to database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    
}
