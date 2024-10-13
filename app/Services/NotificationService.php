<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Http\Resources\NotificationResource;
use App\Models\Property;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    public function __construct(protected NotificationRepository $notificationRepository) {}

    public function getNotifications(): AnonymousResourceCollection
    {
        $user = Auth::user();

        $notifications = $this->notificationRepository->getNotifications($user);
        $notifications->sortByDesc('created_at');

        return NotificationResource::collection($notifications);
    }

    public function deleteNotification(string $id): void
    {
        DB::beginTransaction();
        try {
            // Find the notification by ID for the authenticated user
            $notification = $this->notificationRepository->getNotification($id);

            // Delete the notification
            $notification->delete();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex; // Rethrow the exception
        }
    }

    public function areNotificationsTurnedOff(string $userId, string $propertyId): bool
    {
        return $this->notificationRepository->areNotificationsTurnedOff($userId, $propertyId);
    }

    public function turnOffNotificationsForProperty(Property $property): void
    {
        DB::beginTransaction();
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Authorization check
            if ($user->cannot('turnOffNotifications', $property)) {
                throw new CustomException('You do not have permission to turn off notifications for this property.', 403);
            }

            if ($this->areNotificationsTurnedOff($user->id, $property->id)) {
                throw new CustomException('The notifications already turned off for this property');
            }

            $this->notificationRepository->turnOffNotifications($user->id, $property->id);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function turnOnNotificationsForProperty(Property $property): void
    {
        DB::beginTransaction();
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$this->areNotificationsTurnedOff($user->id, $property->id)) {
                throw new CustomException('The notifications already turned off for this property');
            }

            $this->notificationRepository->turnOnNotifications($user->id, $property->id);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex; // Rethrow the exception
        }
    }
}
