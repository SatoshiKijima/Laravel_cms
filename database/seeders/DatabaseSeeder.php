<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(FamiliesTableSeeder::class); //
        $this->call(UsersTableSeeder::class); //
        $this->call(SupportUsersTableSeeder::class); //
        $this->call(ProductsTableSeeder::class); //
        $this->call(PaymentsTableSeeder::class); //
        $this->call(PrefectureTableSeeder::class); //
        // $this->call(TicketsTableSeeder::class); //
        // $this->call(AddressesSeeder::class); //
    }
}
