<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;
use App\Services\LogoutService;

class LogoutController extends Controller
{
    // Constructor to inject the LogoutService
    public function __construct(protected LogoutService $logoutService) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(LogoutRequest $request)
    {
        try {
            $this->logoutService->logoutUser($request->toDTO());

            return ResponseHelper::sendResponse([], 'User logout successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }
}
