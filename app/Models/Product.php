<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','category','description','price','image','badge','active'];

    protected $casts = ['active' => 'boolean'];
}
