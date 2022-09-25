<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            // code...
            DB::table('products')->insert([
                'category_id' => array_rand([1,2,3]),
                'name' =>'Test Product_' . $i+1,
                'sku' =>'tp-'. $i+1,
                'description' =>'Test Product_' . $i+1 .' test description',
                'buy' =>100,
                'sell' =>110,
                'discount' =>0,
                'new' =>99,
                'out' =>0,
                'stock' =>99,
                'user_id' => 1,
            ]);
        }
        
    }
}
