<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Link};

class UserDashboardController extends Controller
{

// public function index()
// {
//     $adminStats = [
//         'totalUsers' => \App\Models\User::count(),
//         'totalLinks' => Link::count(),
//         'approvedLinks' => Link::where('status', 'approved')->count(),
//         'pendingLinks' => Link::where('status', 'pending')->count(),
//     ];
//     $categories = Category::where('status', '1')->get();
//     $links = auth()->user()->links;
//     return view('dashboard', compact('links', 'categories'));
// }

// public function submitLink(Request $request)
// {
//     $request->validate([
//         'url' => 'required|url',
//         'title' => 'required|string|max:255',
//         'description' => 'nullable|string',
//     ]);

//     auth()->user()->links()->create($request->only('url', 'title', 'description'));
//     return redirect()->route('user.dashboard')->with('success', 'Link submitted for approval.');
// }
}
