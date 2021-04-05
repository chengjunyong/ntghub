<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Huawei','Vivo','Realme','Xiaomi','Vivo']; 

        foreach($array as $result){
          Brand::create([
            'name' => $result,
          ]);
        }
    }
}
