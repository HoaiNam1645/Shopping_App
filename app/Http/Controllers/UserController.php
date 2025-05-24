<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UsersService;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class UserController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function create(Request $request)
    {
        try {
            $result = $this->usersService->createUser($request);
            
            if (is_string($result)) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => $result,
                ], 400);
            }
            
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Tạo người dùng thành công',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Lỗi server',
            ], 500);
        }
    }

    public function getAllUsers() {
        try {
            $result = $this->usersService->getUser();

            if (!$result) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => $result,
                ], 400);
            }

            return response()->json([
                'status' => true,
                'code' => 200,
                'data' => $result
            ], 200);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Lỗi server',
            ], 500);
        }
    }

    public function updateUser(Request $request) {
        $userId = auth('users')->user();
        dd($userId->id);
    }
}
