<?php

namespace App\Http\Requests;

use App\DTOs\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
            'location' => ['required', 'array'],
            'location.governorate' => ['required', 'string'],
            'location.street' => ['required', 'string'],
            'gender' => ['required', 'in:male,female']
        ];
    }

    /**
     * Convert the validated data to a RegisterDTO.
     *
     * @return RegisterDTO
     */
    public function toDTO(): RegisterDTO
    {
        return new RegisterDTO(
            $this->input('first_name'),
            $this->input('last_name'),
            $this->input('phone_number'),
            $this->input('password'), // Leave password as plain text for hashing later
            $this->input('location'),
            $this->input('gender')
        );
    }
}
