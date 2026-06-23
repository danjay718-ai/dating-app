<?php

namespace App\Actions;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class SendMessageAction
{
    /**
     * Send a message inside a conversation.
     *
     * This action also performs an authorization guard:
     * the sender MUST be a participant in the conversation.
     * We enforce this here (in the action) rather than only in the controller,
     * so the rule stays with the business logic regardless of where it's called from.
     *
     * @param  User          $sender        The user sending the message
     * @param  Conversation  $conversation  The conversation to send the message in
     * @param  string        $body          The message content
     * @return Message
     *
     * @throws AuthorizationException
     */
    public function execute(User $sender, Conversation $conversation, string $body): Message
    {
        // Guard: ensure the sender is actually a participant in this conversation.
        $isParticipant = $conversation->participants()
            ->where('users.id', $sender->id)
            ->exists();

        if (! $isParticipant) {
            throw new AuthorizationException('You are not a participant in this conversation.');
        }

        return $conversation->messages()->create([
            'sender_id' => $sender->id,
            'body'      => $body,
        ]);
    }
}
