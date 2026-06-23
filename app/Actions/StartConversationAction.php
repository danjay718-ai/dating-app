<?php

namespace App\Actions;

use App\Models\Conversation;
use App\Models\User;

class StartConversationAction
{
    /**
     * Find an existing conversation between two users, or create a new one.
     *
     * We never want two users to have duplicate conversations.
     * This action checks if a shared conversation already exists before
     * creating a new one — this is the "idempotent" approach.
     *
     * @param  User  $sender    The user who wants to start the chat
     * @param  User  $receiver  The user they want to chat with
     * @return Conversation
     */
    public function execute(User $sender, User $receiver): Conversation
    {
        // Find a conversation where BOTH users are participants.
        // We do this by finding all conversations the sender is in,
        // then checking if the receiver is also in any of those same ones.
        $existing = Conversation::whereHas('participants', function ($query) use ($sender) {
            $query->where('users.id', $sender->id);
        })->whereHas('participants', function ($query) use ($receiver) {
            $query->where('users.id', $receiver->id);
        })->first();

        if ($existing) {
            return $existing;
        }

        // No existing conversation found — create a new one and attach both users.
        $conversation = Conversation::create();

        $conversation->participants()->attach([
            $sender->id,
            $receiver->id,
        ]);

        return $conversation;
    }
}
