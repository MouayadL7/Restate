<?php

namespace App\Repositories;

use App\Models\DeviceToken;

class DeviceTokenRepository
{
    /**
     * Check if the device token exists for the user
     *
     * @param int $userId
     * @param string $deviceToken
     * @return bool
     */
    public function deviceTokenExists(int $userId, string $deviceToken): bool
    {
        return DeviceToken::where('user_id', $userId)
                          ->where('token', $deviceToken)
                          ->exists();
    }

    /**
     * Store a new device token if it doesn't exist
     *
     * @param int $userId
     * @param string $deviceToken
     * @return void
     */
    public function storeDeviceToken(int $userId, string $deviceToken): void
    {
        // Use the separated method to check if the device token already exists
        if (!$this->deviceTokenExists($userId, $deviceToken)) {
            // Create a new device token record
            DeviceToken::create([
                'user_id' => $userId,
                'token' => $deviceToken,
            ]);
        }
    }

    /**
     * Delete a device token
     *
     * @param array $data
     * @return void
     */
    public function deleteDeviceToken(array $data): void
    {
        DeviceToken::where('token', $data['device_token'])->delete();
    }
}
