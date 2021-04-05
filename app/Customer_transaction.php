<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_transaction extends Model
{
    protected $table = 'customer_transaction';
    protected $fillable = [
      'customer_id',
      'category_purchase',
      'brand_id',
      'serial_code',
      'notes',
      'warranty_end_date',
    ];
}
