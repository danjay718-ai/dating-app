<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseProfileController extends Controller
{
    /**
     * Display a list of other users' dating profiles.
     *
     * We eager-load the profile relationship so we don't fire N+1 queries
     * when rendering each card in the view (one query, not one per user).
     *
     * We exclude the currently authenticated user from the list
     * so they don't see their own profile in the browse feed.
     */
    public function index(Request $request): View
    {
        $profiles = User::with('profile')
            ->whereHas('profile')                  // Only show users who have a profile
            ->where('id', '!=', $request->user()->id) // Exclude self
            ->latest()
            ->paginate(12);

        return view('browse.index', compact('profiles'));
    }

    /**
     * Display a single user's dating profile.
     */
    public function show(User $user): View
    {
        $user->load('profile');

        return view('browse.show', compact('user'));
    }
}
