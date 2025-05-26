<?php

namespace App\Services;

use Illuminate\Http\Request;
use Validator;

class AuthService
{
     public function login(Request $request)
     {
          $validator = Validator::make($request->all(), [
               'email'    => 'required|email',
               'password' => 'required|max:20',
          ], [
               'email.required'    => 'Email là bắt buộc!',
               'email.email'       => 'Email phải là định dạng hợp lệ!',
               'password.required' => 'Mật khẩu là bắt buộc!',
               'password.max'      => 'Mật khẩu tối đa 20 kí tự!',
          ]);

          if ($validator->fails()) {
               return [
                    'status'  => false,
                    'code'    => 422,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors'  => $validator->errors()
               ];
          }

          $credentials = $request->only(['email', 'password']);
          $token = auth('users')->attempt($credentials);

          if (!$token) {
               return [
                    'status'  => false,
                    'code'    => 401,
                    'message' => 'Sai email hoặc mật khẩu',
               ];
          }

          $user = auth('users')->user();

          return [
               'status'  => true,
               'code'    => 200,
               'message' => 'Đăng nhập thành công',
               'data'    => [
                    'token' => $token,
                    'user'  => $user, // hoặc ->only(['id', 'email', 'name'])
               ]
          ];
     }
}
