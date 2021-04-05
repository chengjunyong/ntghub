<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Services','Sales','Redeem','Warranty','Other'];

        foreach($array as $result){
          Category::create([
            'name' => $result,
          ]);
        }
    }
}
