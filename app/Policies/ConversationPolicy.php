<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;

class ConversationPolicy
{
    /**
     * Determine if the user can view a specific conversation.
     *
     * Only participants of a conversation can see its messages.
     * We query the pivot table to check if the user belongs to
     * this conversation.
     */
    public function view(User $user, Conversation $conversation): bool
    {
        return $conversation->participants()
            ->where('users.id', $user->id)
            ->exists();
    }

    /**
     * Determine if the user can send a message in a conversation.
     *
     * Same rule — only participants can send messages.
     * This mirrors the guard already in SendMessageAction,
     * but having it here as a Policy makes it reusable via
     * $this->authorize() in any controller.
     */
    public function sendMessage(User $user, Conversation $conversation): bool
    {
        return $conversation->participants()
            ->where('users.id', $user->id)
            ->exists();
    }
}
