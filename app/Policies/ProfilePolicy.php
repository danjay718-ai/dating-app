<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine if the user can update the given profile.
     *
     * A user should only be able to edit their OWN profile.
     * We check this by comparing the profile's user_id to the
     * authenticated user's id.
     */
    public function update(User $user, Profile $profile): bool
    {
        return $user->id === $profile->user_id;
    }

    /**
     * Determine if the user can delete the given profile.
     *
     * Same rule as update — only the owner can delete their profile.
     */
    public function delete(User $user, Profile $profile): bool
    {
        return $user->id === $profile->user_id;
    }
}
