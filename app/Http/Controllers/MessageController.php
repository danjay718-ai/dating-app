<?php

namespace App\Http\Controllers;

use App\Actions\SendMessageAction;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    /**
     * Store a new message in a conversation.
     *
     * The controller receives the validated request and conversation,
     * then delegates the actual work to SendMessageAction.
     *
     * SendMessageAction internally verifies that the sender is a participant,
     * so even if someone bypasses the UI, they cannot send to conversations
     * they don't belong to.
     */
    public function store(
        StoreMessageRequest $request,
        Conversation $conversation,
        SendMessageAction $action
    ): RedirectResponse {
        $action->execute(
            $request->user(),
            $conversation,
            $request->validated('body')
        );

        return redirect()->route('conversations.show', $conversation);
    }
}
