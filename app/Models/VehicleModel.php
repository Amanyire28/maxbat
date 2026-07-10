<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $fillable = ['vehicle_series_id', 'name', 'year_range', 'active', 'sort_order'];
    protected $casts = ['active' => 'boolean'];

    public function series()  { return $this->belongsTo(VehicleSeries::class, 'vehicle_series_id'); }
    public function engines() { return $this->hasMany(VehicleEngine::class); }
}
