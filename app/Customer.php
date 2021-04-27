<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
      'name',
      'email',
      'card_code',
      'card_id',
      'dob',
      'contact',
      'prefer_language',
    ];
}
