<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Services\AuthService;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request);

            if (is_string($result) && $result === 'Wrong email or password') {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => $result,
                ], 400);
            }

            if ($result instanceof \Illuminate\Support\MessageBag) {
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'errors' => $result
                ], 422);
            }

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Đăng nhập thành công',
                'data' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Lỗi server',
            ], 500);
        }
    }
}
