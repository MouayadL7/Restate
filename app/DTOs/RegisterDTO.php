<?php

namespace App\DTOs;

class RegisterDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public string $password,
        public array $location,
        public string $gender
    ) {}

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'password' => bcrypt($this->password),
            'location' => $this->location,
            'gender' => $this->gender
        ];
    }
}
