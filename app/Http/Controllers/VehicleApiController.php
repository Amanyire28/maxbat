<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Models\VehicleBrand;
use App\Models\VehicleSeries;
use App\Models\VehicleModel;
use App\Models\VehicleEngine;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    public function types()
    {
        return response()->json(
            VehicleType::where('active', true)->orderBy('sort_order')->get(['id', 'name'])
        );
    }

    public function brands(Request $request)
    {
        $request->validate(['type_id' => 'required|exists:vehicle_types,id']);
        return response()->json(
            VehicleBrand::where('vehicle_type_id', $request->type_id)
                ->where('active', true)->orderBy('sort_order')->get(['id', 'name'])
        );
    }

    public function series(Request $request)
    {
        $request->validate(['brand_id' => 'required|exists:vehicle_brands,id']);
        return response()->json(
            VehicleSeries::where('vehicle_brand_id', $request->brand_id)
                ->where('active', true)->orderBy('sort_order')->get(['id', 'name'])
        );
    }

    public function models(Request $request)
    {
        $request->validate(['series_id' => 'required|exists:vehicle_series,id']);
        return response()->json(
            VehicleModel::where('vehicle_series_id', $request->series_id)
                ->where('active', true)->orderBy('sort_order')->get(['id', 'name', 'year_range'])
        );
    }

    public function engines(Request $request)
    {
        $request->validate(['model_id' => 'required|exists:vehicle_models,id']);
        return response()->json(
            VehicleEngine::where('vehicle_model_id', $request->model_id)
                ->where('active', true)->orderBy('sort_order')->get(['id', 'name', 'displacement', 'power', 'fuel_type'])
        );
    }
}
