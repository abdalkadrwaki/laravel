<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // إنشاء مستخدم افتراضي
        User::create([
            'name' => 'Admin User',
            'email' => 'abdalkadrhmidan@gmail.com',
            'password' => Hash::make('12345678'), // تأكد من استخدام كلمة مرور قوية
            'role_id' => 1, // افترض أن الدور 1 هو دور المدير
            'link_number' => str_pad(random_int(0, 9999999999999999), 16, '0', STR_PAD_LEFT), // إضافة رقم عشوائي مكون من 16 خانة
        ]);
    }
}
