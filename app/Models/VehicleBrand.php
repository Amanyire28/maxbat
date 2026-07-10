<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    protected $fillable = ['vehicle_type_id', 'name', 'active', 'sort_order'];
    protected $casts = ['active' => 'boolean'];

    public function type()   { return $this->belongsTo(VehicleType::class, 'vehicle_type_id'); }
    public function series() { return $this->hasMany(VehicleSeries::class); }
}
