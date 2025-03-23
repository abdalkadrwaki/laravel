<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransfersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $transfers = [];

        // نقوم بإدخال بيانات وهمية لـ 50,000 تحويل
        for ($i = 0; $i < 5000; $i++) {
            $transfers[] = [
                'user_id' => $faker->randomElement([2, 3]), // مع افتراض أن المستخدمين موجودين بالفعل
                'movement_number' => $faker->unique()->numberBetween(1000000000, 9999999999),
                'password' => $faker->word,
                'recipient_name' => $faker->name,
                'recipient_mobile' => $faker->phoneNumber,
                'destination' => $faker->randomElement([2, 3]), // مع افتراض أن المستخدمين موجودين
                'parent_id' => $faker->randomElement([null, 2, 3]), // مع افتراض أن بعض التحويلات لا تحتوي على parent_id
                'sent_currency' => 'USD', // يمكنك تغييرها وفقًا للعملات الموجودة في جدول 'currencies'
                'sent_amount' => $faker->randomFloat(2, 10, 1000), // مبلغ مرسل عشوائي بين 10 و 1000
                'received_currency' => 'EUR', // يمكنك تغييرها وفقًا للعملات الموجودة في جدول 'currencies'
                'received_amount' => $faker->randomFloat(2, 10, 1000), // مبلغ مستلم عشوائي
                'fees' => $faker->randomFloat(2, 0, 50),
                'exchange_rate' => $faker->randomFloat(4, 1, 5),
                'status' => $faker->randomElement(['Pending', 'Delivered', 'Frozen', 'Cancelled', 'Archived']),
                'statuss' => $faker->randomElement(['Pending', 'Delivered', 'Frozen', 'Cancelled']),
                'transaction_type' => 'Transfer', // تم تحديده يدويًا 'Transfer'
                'note' => null, // لا يوجد ملاحظات
                'recipient_info' => $faker->text,
                'Office_name' => $faker->company,
                'created_at' => $faker->dateTimeBetween('2025-01-01', '2025-12-31'), // تواريخ عشوائية في 2025
                'updated_at' => $faker->dateTimeBetween('2025-01-01', '2025-12-31'), // تواريخ عشوائية في 2025
            ];

            // كل 500 سجل نقوم بإدخالها دفعة واحدة
            if (count($transfers) >= 500) {
                DB::table('transfers')->insert($transfers);
                $transfers = []; // إعادة تعيين المصفوفة بعد الإدخال
            }
        }

        // في حال تبقى بعض السجلات
        if (count($transfers) > 0) {
            DB::table('transfers')->insert($transfers);
        }
    }
}
