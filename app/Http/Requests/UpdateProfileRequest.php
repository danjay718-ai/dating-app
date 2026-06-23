<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Only authenticated users can update their profile.
     */
    public function authorize(): bool
    {
        return true; // Route is already protected by the 'auth' middleware
    }

    /**
     * Validation rules for the dating profile fields.
     *
     * These are intentionally practical and minimal for a PoC.
     * We validate the most important inputs to keep the app functional and safe.
     */
    public function rules(): array
    {
        return [
            'age'               => ['required', 'integer', 'min:18', 'max:100'],
            'bio'               => ['nullable', 'string', 'max:500'],
            'gender'            => ['nullable', 'string', 'in:male,female,non-binary'],
            'looking_for_gender'=> ['nullable', 'string', 'in:male,female,non-binary,any'],
            'location'          => ['nullable', 'string', 'max:100'],
        ];
    }
}
