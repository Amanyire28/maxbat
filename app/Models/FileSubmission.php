<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileSubmission extends Model
{
    protected $fillable = [
        'customer_name','phone','email',
        'car_brand','car_model','chassis_no',
        'vehicle_type_id','vehicle_brand_id','vehicle_series_id','vehicle_model_id','vehicle_engine_id',
        'service_id','file_type','file_path',
        'original_filename','file_size','notes','status',
    ];

    public function service()       { return $this->belongsTo(Service::class); }
    public function vehicleType()   { return $this->belongsTo(VehicleType::class); }
    public function vehicleBrand()  { return $this->belongsTo(VehicleBrand::class); }
    public function vehicleSeries() { return $this->belongsTo(VehicleSeries::class); }
    public function vehicleModel()  { return $this->belongsTo(VehicleModel::class, 'vehicle_model_id'); }
    public function vehicleEngine() { return $this->belongsTo(VehicleEngine::class); }

    /** Human-readable vehicle summary */
    public function getVehicleSummaryAttribute(): string
    {
        $parts = array_filter([
            $this->vehicleType?->name,
            $this->vehicleBrand?->name,
            $this->vehicleSeries?->name,
            $this->vehicleModel?->name,
            $this->vehicleEngine?->name,
        ]);
        return $parts ? implode(' / ', $parts) : ($this->car_brand . ' ' . $this->car_model);
    }
}
