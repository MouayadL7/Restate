<?php

namespace App\Services;

use App\DTOs\LogoutDTO;
use App\Repositories\DeviceTokenRepository;
use Illuminate\Support\Facades\Auth;

class LogoutService
{
    public function __construct(protected DeviceTokenRepository $deviceTokenRepository) {}

    public function logoutUser(LogoutDTO $dto): void
    {
        $this->deviceTokenRepository->deleteDeviceToken($dto->toArray());

        request()->user()->token()->revoke();
    }
}
