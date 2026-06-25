<?php

namespace App\Http\Controllers;

use App\Actions\SendMessageAction;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a new message in a conversation.
     *
     * The controller receives the validated request and conversation,
     * then delegates the actual work to SendMessageAction.
     *
     * ConversationPolicy::sendMessage() is checked here via $this->authorize()
     * before the action is even called — clean, declarative authorization.
     * SendMessageAction also has its own participant guard as a safety net.
     */
    public function store(
        StoreMessageRequest $request,
        Conversation $conversation,
        SendMessageAction $action
    ): RedirectResponse {
        $this->authorize('sendMessage', $conversation);

        $action->execute(
            $request->user(),
            $conversation,
            $request->validated('body')
        );

        return redirect()->route('conversations.show', $conversation);
    }
}
