<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status', '1')
                        // ->withCount('approvedLinks')
                        // ->orderBy('approved_links_count', 'desc')
                        // ->take(10)
                        ->get();
        return view('frontend.home', compact('categories'));
    }

    public function categoryPosts($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 'published')->paginate(10);
        return view('frontend.category_posts', compact('category', 'posts'));
    }

    public function submit_link(){
        $categories = Category::where('status', '1')->get();
        return view('frontend.pages.submit_link', compact('categories'));
    }

    public function login(){
        return view('frontend.pages.login');
    }

    public function register(){
        return view('frontend.pages.register');
    }

    /**
     * Generate a new captcha code
     */
    public function generateCaptcha()
    {
        // Generate a random 6-character alphanumeric code
        $captcha = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));

        // Store the captcha in session
        session()->put('submit_link_captcha', $captcha);

        return response()->json([
            'captcha' => $captcha
        ]);
    }

    /**
     * Handle submit link form submission
     */
    public function submitLink(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'pricing' => 'required|in:featured,regular,reciprocal',
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'nullable|string|max:1000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string',
            'captcha' => 'required|string',
            'agreement' => 'accepted'
        ]);

        // Verify captcha
        if (strtoupper($request->captcha) !== session()->get('submit_link_captcha')) {
            return back()
                ->withErrors(['captcha' => 'The captcha code you entered is incorrect.'])
                ->withInput();
        }

        // Clear the captcha from session after verification
        session()->forget('submit_link_captcha');

        // Here you would typically save the link submission to database
        // For now, we'll just return success message

        return back()->with('success', 'Your link has been submitted successfully! It will be reviewed shortly.');
    }
}
