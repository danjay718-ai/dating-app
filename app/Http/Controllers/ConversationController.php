<?php

namespace App\Http\Controllers;

use App\Actions\StartConversationAction;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConversationController extends Controller
{
    /**
     * List all conversations the authenticated user is part of.
     *
     * We eager-load participants (with their profiles) and the latest message
     * so the conversation list can show a preview without extra queries.
     */
    public function index(Request $request): View
    {
        $conversations = $request->user()
            ->conversations()
            ->with([
                'participants.profile', // Load participant profiles for display
                'messages' => fn ($q) => $q->latest()->limit(1), // Latest message preview
            ])
            ->latest()
            ->get();

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Start or find a conversation with another user, then redirect to it.
     *
     * This uses Route Model Binding — Laravel automatically resolves
     * the User from the {user} segment in the URL.
     */
    public function store(
        Request $request,
        User $user,
        StartConversationAction $action
    ): RedirectResponse {
        // Prevent starting a conversation with yourself
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'You cannot start a conversation with yourself.');
        }

        $conversation = $action->execute($request->user(), $user);

        return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Show a single conversation and all its messages.
     *
     * Authorization is handled by ConversationPolicy::view().
     * Laravel will automatically throw a 403 if the policy returns false.
     */
    public function show(Conversation $conversation): View
    {
        $this->authorize('view', $conversation);

        $conversation->load([
            'messages.sender.profile', // Load sender info for each message
            'participants.profile',    // Load all participant profiles
        ]);

        return view('conversations.show', compact('conversation'));
    }
}
