<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
          'card_id' => "100001",
          'card_code' => 'abc123',
          'name' => 'Ethan Cheng',
          'email' => 'junyong1213@hotmail.com',
          'contact' => '+60169531213',
          'dob' => '1996-10-10',
        ]);
    }
}
