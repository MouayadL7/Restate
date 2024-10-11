<?php

namespace App\Services;

use App\DTOs\LoginDTO;
use App\Exceptions\LoginException;
use App\Helpers\ResponseHelper;
use App\Repositories\DeviceTokenRepository;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function __construct(protected DeviceTokenRepository $deviceTokenRepository) {}

    public function loginUser(LoginDTO $dto)
    {
        try {
            // Attempt to authenticate the user
            if (!Auth::attempt($dto->toArray())) {
                throw new LoginException('Invalid phone number or password', 401);
            }

            // Retrieve the authenticated user
            $user = Auth::user();

            // Store device token if not already in the database
            $this->deviceTokenRepository->storeDeviceToken($user->id, $dto->device_token);

            // Generate token
            /**
             * @var App\Models\User $user
             */
            $token = $user->createToken('Personal Access Token')->accessToken;

            return [
                'user' => $user,
                'token' => $token
            ];
        } catch (\Exception $ex) {
            throw $ex; // Rethrow the exception
        }
    }
}
