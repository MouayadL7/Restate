<?php

namespace App\Http\Controllers\Notification;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notificationService) {}

    public function getNotifications()
    {
        $notifications = $this->notificationService->getNotifications();

        return ResponseHelper::sendResponse($notifications, 'Notifications retrived successfully');
    }

    public function deleteNotification(string $id)
    {
        try {
            $this->notificationService->deleteNotification($id);

            return ResponseHelper::sendResponse([], 'Notification deleted successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }

    public function turnOffNotificationsForProperty(Property $property)
    {
        try {
            $this->notificationService->turnOffNotificationsForProperty($property);

            return ResponseHelper::sendResponse([], 'TurnOff notifications for this property successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }

    public function turnOnNotificationsForProperty(Property $property)
    {
        try {
            $this->notificationService->turnOnNotificationsForProperty($property);

            return ResponseHelper::sendResponse([], 'TurnOn notifications for this property successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }
}
