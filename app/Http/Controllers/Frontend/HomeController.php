<?php

namespace App\Http\Controllers\Frontend;

use App\Models\{Category, Link, Blog, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '1')->get();
        $links = Link::where('status', 'approved')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $blogs = Blog::where('is_published', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.home', compact('categories', 'links', 'blogs'));
    }

    public function categoryPosts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $links = $category->links()
            ->where('status', 'approved')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.category_posts', compact('category', 'links'));
    }

    public function submit_link()
    {
        $links = Link::where('status', 'pending')->get();
        $categories = Category::where('status', '1')->get();
        $blogs = Blog::where('is_published', '1')->get();
        return view('frontend.pages.submit_link', compact('categories', 'links', 'blogs'));
    }

    public function login()
    {
        return view('frontend.pages.login');
    }

    public function register()
    {
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

        // Handle User Logic
        $user = auth()->user();

        if (!$user) {
            // Check if user exists by email
            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                // Create new user if not exists
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make(Str::random(16)),
                    'plan' => 'free',
                ]);

                // Send password setup email (reset link)
                Password::sendResetLink($user->only('email'));
            }
        }

        // Save the link submission to database
        $links = Link::create([
            'user_id' => $user->id,
            'category_id' => $validated['category'],
            'url' => $validated['url'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'pricing_type' => $validated['pricing'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your link has been submitted successfully! It will be reviewed shortly. We sent you an email to set up your password. Please check your email.');
    }

    public function showLink($slug)
    {
        $link = Link::where('slug', $slug)->firstOrFail();

        $link->increment('hits');

        $categories = Category::where('status', '1')->get();
        $links = collect([$link]);
        $blogs = Blog::where('is_published', '1')->get();

        return view('frontend.pages.link-details', compact('categories', 'links', 'blogs'));
    }

}
