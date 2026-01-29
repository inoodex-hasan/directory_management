<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Link};

class DashboardController extends Controller
{

 public function index()
{
    $user = auth()->user();

    // Data for every logged-in user (Personal Stats)
    $myLinksCount = Link::where('user_id', $user->id)->count();
    $myPendingCount = Link::where('user_id', $user->id)->where('status', 'pending')->count();
    $recentSubmissions = Link::where('user_id', $user->id)->latest()->take(5)->get();

    // Admin-specific data - Updated to use isAdmin() method
    $adminStats = [];
    
    if ($user->isAdmin()) { 
        $adminStats = [
            'total_pending_all' => Link::where('status', 'pending')->count(),
            'total_categories'  => Category::count(),
            'all_recent'        => Link::with(['user', 'category'])->latest()->take(5)->get()
        ];
    }

    return view('dashboard', compact(
        'myLinksCount', 
        'myPendingCount', 
        'recentSubmissions', 
        'adminStats'
    ));
}

    public function create()
    {
        $categories = Category::all();
        return view('links.create', compact('categories'));
    }

    public function store(Request $request)
    {
    // 1. Validate the input
    $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'required|url|unique:links,url',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string|max:500',
    ]);

    // 2. Save the link
    Link::create([
        'title' => $request->title,
        'url' => $request->url,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'user_id' => auth()->id(), // Associate with logged-in user
        'status' => 'pending',     // Always start as pending
    ]);

    return redirect()->back()->with('success', 'Link submitted successfully! It will appear once approved.');
    }
}