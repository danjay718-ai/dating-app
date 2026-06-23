<?php

namespace App\Actions;

use App\Models\User;

class UpdateProfileAction
{
    /**
     * Create or update the dating profile for a given user.
     *
     * We use updateOrCreate() because a user might not have a profile yet
     * (first time setup) or may already have one (editing it).
     *
     * @param  User   $user  The authenticated user
     * @param  array  $data  Validated data from the Form Request
     * @return void
     */
    public function execute(User $user, array $data): void
    {
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],  // Find the record by this condition
            $data                       // Create or update with this data
        );
    }
}
