<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $fillable = ['name', 'active', 'sort_order'];
    protected $casts = ['active' => 'boolean'];

    public function brands() { return $this->hasMany(VehicleBrand::class); }
}
