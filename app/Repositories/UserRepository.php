<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        try {
            // Attempt to create a new user
            return User::create($data);
        } catch (\Exception $ex) {
            throw $ex; // Rethrow the exception
        }
    }
}
