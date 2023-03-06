<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $payments = [
            [
                'name' => 'PayPay',
                'image_url' => 'https://example.com/paypay.png',
            ],
            [
                'name' => 'クレジットカード',
                'image_url' => 'https://example.com/credit_card.png',
            ],
            [
                'name' => '楽天Edy',
                'image_url' => 'https://example.com/rakuten_edy.png',
            ],
            [
                'name' => 'LINE Pay',
                'image_url' => 'https://example.com/line_pay.png',
            ],
            [
                'name' => '銀行振込',
                'image_url' => 'https://example.com/bank_transfer.png',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}