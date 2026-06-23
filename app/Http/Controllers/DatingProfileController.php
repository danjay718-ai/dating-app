<?php

namespace App\Http\Controllers;

use App\Actions\UpdateProfileAction;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DatingProfileController extends Controller
{
    /**
     * Show the dating profile edit form.
     *
     * We load the user with their profile so the form can be pre-filled.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('profile');

        return view('dating-profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's dating profile.
     *
     * The controller stays thin — it only handles the HTTP layer.
     * The actual saving logic lives in UpdateProfileAction.
     */
    public function update(UpdateProfileRequest $request, UpdateProfileAction $action): RedirectResponse
    {
        $action->execute($request->user(), $request->validated());

        return redirect()->route('dating-profile.edit')->with('status', 'Profile updated!');
    }
}
