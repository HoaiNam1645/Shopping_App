<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UsersService
{
     /**
      * Create a new user
      * 
      * @param Request $request
      * @return Model|string
      */
     public function createUser(Request $request)
     {
          try {
               $fullName = $request->full_name;
               $email = $request->email;
               $password = $request->password;
               $phone = $request->phone;
               $address = $request->address;

               if (empty($fullName) || empty($email) || empty($password) || empty($phone) || empty($address)) {
                    return 'Vui lòng nhập đầy đủ thông tin';
               }

               $existingUser = User::where('email', $email)->first();
               if ($existingUser) {
                    return 'Email đã tồn tại';
               }

               $password = bcrypt($password);
               $user = User::create([
                    'full_name' => $fullName,
                    'email' => $email,
                    'password' => $password,
                    'phone' => $phone,
                    'address' => $address
               ]);

               if (!$user) {
                    return 'Tạo người dùng thất bại';
               }

               return $user;
          } catch (\Exception $e) {
               \Log::error('User creation error: ' . $e->getMessage());

               return 'Lỗi server';
          }
     }

     public function getUser()
     {
          try {
               $users = User::all();

               if (!$users) {
                    return 'Không tìm thấy người dùng';
               }

               return $users;
          } catch (\Exception $e) {
               return 'Lỗi server';
          }
     }
}
