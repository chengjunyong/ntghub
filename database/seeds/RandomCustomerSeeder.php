<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Customer;
class RandomCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($a=0;$a<300;$a++){
          $timestamp = mt_rand(1, time());
          $randomDate = date("Y-m-d", $timestamp);
          Customer::create([
            'card_id' => Str::random(15),
            'card_code' => Str::random(25),
            'name' => Str::random(10),
            'email' => Str::random(7)."@gmail.com",
            'contact' => "+60".rand(100000000,9999999999),
            'dob' => $randomDate,
          ]); 
        }
    }
}
