<?php

namespace App\DTOs;

class LogoutDTO
{
    public function __construct(public string $device_token) {}

    public function toArray(): array
    {
        return [
            'device_token' => $this->device_token
        ];
    }
}
