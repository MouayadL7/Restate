<?php

namespace App\Http\Requests;

use App\DTOs\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone_number' => ['required', 'string', 'exists:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
            'device_token' => ['required', 'string']
        ];
    }

    /**
     * Convert the validated data to a LoginDTO.
     *
     * @return LoginDTO
     */
    public function toDTO(): LoginDTO
    {
        return new LoginDTO(
            $this->input('phone_number'),
            $this->input('password'), // Leave password as plain text for hashing later
            $this->input('device_token')
        );
    }
}
