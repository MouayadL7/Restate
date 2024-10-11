<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginService;

    // Constructor to inject the LoginService
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        try {
            $response = $this->loginService->loginUser($request->toDTO());

            return ResponseHelper::sendResponse($response, 'User logged in successfully');
        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage());
        }
    }
}
