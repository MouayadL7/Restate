<?php

namespace App\DTOs;

class LoginDTO
{
    public function __construct(
        public string $phone_number,
        public string $password,
        public string $device_token
    ) {}

    public function toArray(): array
    {
        return [
            'phone_number' => $this->phone_number,
            'password' => $this->password
        ];
    }
}
