<?php

use Illuminate\Database\Seeder;
use App\Customer_transaction;
use Illuminate\Support\Str;

class RandomTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($a=0;$a<100;$a++){
          $timestamp = mt_rand(1, time());
          $randomDate = date("Y-m-d", $timestamp);
          Customer_transaction::create([
            'customer_id' => '1',
            'category_purchase' => rand(1,5),
            'brand_id' => rand(1,5),
            'serial_code' => Str::random(15),
            'warranty_end_date' => $randomDate,
            'notes' => "Testing Data",
          ]);
        }
    }
}
