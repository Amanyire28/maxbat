<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSeries extends Model
{
    protected $fillable = ['vehicle_brand_id', 'name', 'active', 'sort_order'];
    protected $casts = ['active' => 'boolean'];

    public function brand()  { return $this->belongsTo(VehicleBrand::class, 'vehicle_brand_id'); }
    public function models() { return $this->hasMany(VehicleModel::class); }
}
