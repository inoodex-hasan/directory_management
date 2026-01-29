<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\{Category, Link};
use App\Http\Controllers\Controller;

class LinkController extends Controller
{

public function index()
{
    // Fetch only the links submitted by the logged-in user
    $links = Link::where('user_id', auth()->id())
                ->with('category')
                ->latest()
                ->paginate(10);

    return view('user.links.index', compact('links'));
}
    public function create()
    {
        $categories = Category::all();
        return view('user.links.create', compact('categories'));
    }

public function store(Request $request)
{
    $user = auth()->user();
    
    if ($user->plan === 'free' && $user->links()->count() >= 5) {
        return redirect()->back()->with('error', 'Free accounts are limited to 5 links. Please upgrade!');
    }

    
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'url'         => 'required|url|unique:links,url',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string|max:500',
    ]);

    $finalStatus = ($user->plan === 'free') ? 'pending' : 'approved';

    
    Link::create([
        'title'       => $validated['title'],
        'url'         => $validated['url'],
        'category_id' => $validated['category_id'],
        'description' => $validated['description'],
        'user_id'     => $user->id,
        'status'      => $finalStatus,
    ]);

    $message = ($finalStatus === 'approved') 
                ? 'Link published instantly! Thank you for being a Premium member.' 
                : 'Link submitted successfully! It will appear once approved.';

    return redirect()->route('links.index')->with('success', $message);
}

    public function pending()
{
    if (!auth()->user()->isAdmin()) {
        abort(403);
    }

    $links = Link::with(['user', 'category'])
                 ->where('status', 'pending')
                 ->latest()
                 ->paginate(15);

    return view('admin.links.pending', compact('links'));
}

public function processed()
{
    // Ensure only admins can access
    if (!auth()->user()->isAdmin()) {
        abort(403);
    }

    $links = Link::with(['user', 'category'])
                 ->whereIn('status', ['approved', 'rejected'])
                 ->latest()
                 ->paginate(20);

    return view('admin.links.index', compact('links'));
}

public function edit(Link $link)
{
    $categories = Category::all();
    return view('admin.links.edit', compact('link', 'categories'));
}

public function update(Request $request, Link $link)
{
    // Validate only the status
    $request->validate([
        'status' => 'required|in:pending,approved,rejected',
    ]);

    // Only update the status column
    $link->update([
        'status' => $request->status
    ]);

    return redirect()->route('admin.links.processed')
                     ->with('success', 'Link status has been updated.');
}

    public function updateStatus(Request $request, Link $link)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);

        $link->update(['status' => $request->status]);

        return back()->with('success', "Link has been {$request->status}.");
    }
}
