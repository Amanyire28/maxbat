<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleEngine extends Model
{
    protected $fillable = ['vehicle_model_id', 'name', 'displacement', 'power', 'fuel_type', 'active', 'sort_order'];
    protected $casts = ['active' => 'boolean'];

    public function vehicleModel() { return $this->belongsTo(VehicleModel::class, 'vehicle_model_id'); }
}
