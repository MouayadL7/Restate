<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $registerService;

    // Constructor to inject the RegisterService
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = $this->registerService->registerUser($request->toDTO());

            return ResponseHelper::sendResponse($user, 'User registerd successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }
}
