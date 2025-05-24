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
               return $validator->errors();
          }

          $credentials = request(['email', 'password']);
          // admin
          $token = auth('users')->attempt($credentials);
          if ($token) {
               return $token;
          }
          //tim cac model va khong co ket qua thi se tra ve la khong tim
          return 'Wrong email or password';
     }
}
