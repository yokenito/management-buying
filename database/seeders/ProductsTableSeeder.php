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
        for($i=1; $i<=5; $i++){
            Product::create([
                'product_id' => 1000+$i ,
                'product_name'=> '電子部品'.$i,
            ]);
        }
        for($i=1; $i<=5; $i++){
            Product::create([
                'product_id' => 2000+$i ,
                'product_name'=> '機器'.$i,
            ]);
        }
        for($i=1; $i<=5; $i++){
            Product::create([
                'product_id' => 3100+$i ,
                'product_name'=> '小部品'.$i,
            ]);
        }
    }
}
