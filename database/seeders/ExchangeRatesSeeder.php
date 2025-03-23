<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // قائمة العملات التي سيتم استخدامها في الأزواج
        $currencies = ['USD', 'EUR', 'TRY', 'SAR', 'SYP'];

        // مصفوفة لتخزين الأزواج والأسعار
        $rates = [];

        // توليد جميع الأزواج الممكنة من العملات
        foreach ($currencies as $currency1) {
            foreach ($currencies as $currency2) {
                if ($currency1 !== $currency2) {  // استبعاد الأزواج المتشابهة
                    $pair = $currency1 . '/' . $currency2;
                    $name_ar = $this->generateCurrencyPairName($currency1, $currency2);

                    // تعيين قيم سعر الشراء والبيع الافتراضية
                    $buy_rate = rand(1, 50) * 0.1;  // قيمة عشوائية بين 1 و 50 مع خطوة 0.1
                    $sell_rate = $buy_rate + rand(1, 5) * 0.05;  // سعر البيع أعلى من الشراء بمقدار عشوائي

                    $rates[] = [
                        'currency_pair' => $pair,
                        'name_ar' => $name_ar,
                        'buy_rate' => $buy_rate,
                        'sell_rate' => $sell_rate,
                    ];
                }
            }
        }

        // إضافة جميع الأزواج إلى قاعدة البيانات
        foreach ($rates as $rate) {
            \App\Models\ExchangeRate::updateOrCreate(
                ['currency_pair' => $rate['currency_pair']],
                $rate
            );
        }
    }

    /**
     * توليد اسم الزوج باللغتين العربية والإنجليزية.
     *
     * @param string $currency1
     * @param string $currency2
     * @return string
     */
    private function generateCurrencyPairName($currency1, $currency2)
    {
        $names = [
            'USD' => 'الدولار الأمريكي',
            'EUR' => 'اليورو',
            'TRY' => 'الليرة التركية',
            'SAR' => 'الريال السعودي',
            'SYP' => 'الليرة السورية',
        ];

        return $names[$currency1] . '/' . $names[$currency2];
    }
}
