<?php

namespace App\Repositories;

use App\Models\NotificationSetting;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class NotificationRepository
{
    public function areNotificationsTurnedOff(string $userId, string $propertyId): bool
    {
        return NotificationSetting::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->exists();
    }

    public function getNotifications(User $user): Collection
    {
        return $user->notifications;
    }

    public function getNotification(string $id)
    {
        try {
            return Auth::user()->notifications->findOrFail($id);
        } catch (\Exception $ex) {
            throw $ex; // Rethrow the excrption
        }
    }

    public function turnOffNotifications(string $userId, string $propertyId):void
    {
        try {
            NotificationSetting::create([
                'user_id' => $userId,
                'property_id' => $propertyId
            ]);
        } catch (\Exception $ex) {
            throw $ex; // Rethrow the exception
        }
    }

    public function turnOnNotifications(string $userId, string $propertyId): void
    {
        try {
            NotificationSetting::create([
                'user_id' => $userId,
                'property_id' => $propertyId,
                'notifications_disabled' => true
            ]);
        } catch (\Exception $ex) {
            throw $ex; // Rethrow the exception
        }
    }
}
