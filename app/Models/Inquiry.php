<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name','phone','email','vehicle_make','vehicle_model','service','message','status'
    ];
}
