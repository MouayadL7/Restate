<?php

namespace App\Http\Requests;

use App\DTOs\LogoutDTO;
use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
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
            'device_token' => ['required', 'string', 'exists:device_tokens,token']
        ];
    }

    /**
     * Convert the validated data to a LoginDTO.
     *
     * @return LogoutDTO
     */
    public function toDTO(): LogoutDTO
    {
        return new LogoutDTO(
            $this->input('device_token')
        );
    }
}
