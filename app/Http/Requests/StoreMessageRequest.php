<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Only authenticated users can send messages.
     */
    public function authorize(): bool
    {
        return true; // Route is already protected by the 'auth' middleware
    }

    /**
     * Validation rules for sending a message.
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:2000'],
        ];
    }
}
