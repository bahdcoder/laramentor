<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMentorshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'days' => 'required|integer', //TODO: write a custom validation rule for this.
            'description' => 'required',
            'for' => 'required|in:mentor,mentee',
            'mentorship_duration' => 'required|integer',
            'session_duration' => 'required|integer',
            'pairing_time' => 'required|date_format:H:i'
        ];
    }
}
