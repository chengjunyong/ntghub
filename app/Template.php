<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';
    protected $fillable = [
      'template_name',
      'category',
      'dir',
      'path',
    ];
}
