<?php

namespace Joymap\database\seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            ['name' => '現金'],
            ['name' => 'Visa'],
            ['name' => 'Master'],
            ['name' => 'JCB'],
            ['name' => 'Apple Pay'],
            ['name' => 'Google Pay'],
            ['name' => 'LINE Pay'],
            ['name' => '悠遊卡'],
            ['name' => '微信支付'],
            ['name' => '支付寶']
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
