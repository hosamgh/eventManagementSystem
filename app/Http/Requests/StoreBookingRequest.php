<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'user_email' => [
                'required',
                'email',
                Rule::unique('bookings')->where(
                    fn($query) =>
                    $query->where('event_id', $this->input('event_id'))
                ),
            ],
            'mobile_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('bookings')->where(
                    fn($query) =>
                    $query->where('event_id', $this->input('event_id'))
                ),
            ],
        ];
    }
}
