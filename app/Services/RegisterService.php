<?php

namespace App\Services;

use App\DTOs\RegisterDTO;
use App\Helpers\ResponseHelper;
use App\Models\User;
use App\Repositories\UserRepository;

class RegisterService
{
    protected $userRepository;
    protected $smsService;

    public function __construct(UserRepository $userRepository, SMSService $smsService)
    {
        $this->userRepository = $userRepository;
        $this->smsService = $smsService;
    }

    public function registerUser(RegisterDTO $dto): User
    {
        try {
            // Store user in database using repository
            $user = $this->userRepository->create($dto->toArray());

            // Send OTP to the user's phone using SMSService
            $this->smsService->sendOTP($user->phone_number);

            return $user;
        } catch (\Exception $ex) {
            return ResponseHelper::sendError('Registration failed: ' . $ex->getMessage());
        }
    }

}
