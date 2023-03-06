<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 1; $j <= 20; $j++) {
            // 単価を計算するためのベース価格
            $base_price = 0;

            // 5つの商品を作成するループ
            for ($i = 1; $i <= 5; $i++) {
                // 単価を計算する
                $price = $base_price + $i * 500;
                
                // 商品を作成するループ
            for ($j = 1; $j <= 20; $j++) {
                // 商品名と説明文を作成する
                $product_name = "みらいチケット" . chr($i + 64) . $j;
                $description = $product_name . " " . number_format($base_price + $j * 500) . "円";


            Product::create([
                'product_name' => $product_name,
                'price' => $base_price + $j * 500,
                'product_description' => "{$description}分利用できます",
                ]);
        }
    }
  }
 }
}