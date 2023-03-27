<?php

namespace Database\Seeders;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('tickets')->insert([
                'support_user_id' => rand(1, 10),
                'product_id' => rand(1, 20),
                'area_id' => rand(1, 20),
                'giftcard_id' => rand(1, 4),
                'numbers' => rand(1, 10),
                'gift_sender' => $faker->name,
                'message' => $faker->text(50),
                'use' => null,
                'get_date' => null,
                'used_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
