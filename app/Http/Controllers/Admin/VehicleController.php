<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use App\Models\VehicleBrand;
use App\Models\VehicleSeries;
use App\Models\VehicleModel;
use App\Models\VehicleEngine;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // ── TYPES ──────────────────────────────────────────────────────────

    public function typesIndex()
    {
        $types = VehicleType::withCount('brands')->orderBy('sort_order')->get();
        return view('admin.vehicles.types', compact('types'));
    }

    public function typeStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        VehicleType::create(['name' => $request->name, 'sort_order' => $request->sort_order ?? 0, 'active' => true]);
        return back()->with('success', 'Vehicle type added.');
    }

    public function typeUpdate(Request $request, VehicleType $vehicleType)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        $vehicleType->update([
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'active'     => $request->boolean('active', true),
        ]);
        return back()->with('success', 'Vehicle type updated.');
    }

    public function typeDestroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();
        return back()->with('success', 'Vehicle type deleted.');
    }

    // ── BRANDS ─────────────────────────────────────────────────────────

    public function brandsIndex(VehicleType $vehicleType)
    {
        $brands = $vehicleType->brands()->withCount('series')->orderBy('sort_order')->get();
        return view('admin.vehicles.brands', compact('vehicleType', 'brands'));
    }

    public function brandStore(Request $request, VehicleType $vehicleType)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        $vehicleType->brands()->create(['name' => $request->name, 'sort_order' => $request->sort_order ?? 0, 'active' => true]);
        return back()->with('success', 'Brand added.');
    }

    public function brandUpdate(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        $vehicleBrand->update(['name' => $request->name, 'sort_order' => $request->sort_order ?? 0, 'active' => $request->boolean('active', true)]);
        return back()->with('success', 'Brand updated.');
    }

    public function brandDestroy(VehicleType $vehicleType, VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->delete();
        return back()->with('success', 'Brand deleted.');
    }

    // ── SERIES ─────────────────────────────────────────────────────────

    public function seriesIndex(VehicleType $vehicleType, VehicleBrand $vehicleBrand)
    {
        $seriesList = $vehicleBrand->series()->withCount('models')->orderBy('sort_order')->get();
        return view('admin.vehicles.series', compact('vehicleType', 'vehicleBrand', 'seriesList'));
    }

    public function seriesStore(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        $vehicleBrand->series()->create(['name' => $request->name, 'sort_order' => $request->sort_order ?? 0, 'active' => true]);
        return back()->with('success', 'Series added.');
    }

    public function seriesUpdate(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries)
    {
        $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        $vehicleSeries->update(['name' => $request->name, 'sort_order' => $request->sort_order ?? 0, 'active' => $request->boolean('active', true)]);
        return back()->with('success', 'Series updated.');
    }

    public function seriesDestroy(VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries)
    {
        $vehicleSeries->delete();
        return back()->with('success', 'Series deleted.');
    }

    // ── MODELS ─────────────────────────────────────────────────────────

    public function modelsIndex(VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries)
    {
        $models = $vehicleSeries->models()->withCount('engines')->orderBy('sort_order')->get();
        return view('admin.vehicles.models', compact('vehicleType', 'vehicleBrand', 'vehicleSeries', 'models'));
    }

    public function modelStore(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries)
    {
        $request->validate(['name' => 'required|string|max:100', 'year_range' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer']);
        $vehicleSeries->models()->create([
            'name' => $request->name, 'year_range' => $request->year_range,
            'sort_order' => $request->sort_order ?? 0, 'active' => true,
        ]);
        return back()->with('success', 'Model added.');
    }

    public function modelUpdate(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel)
    {
        $request->validate(['name' => 'required|string|max:100', 'year_range' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer']);
        $vehicleModel->update([
            'name' => $request->name, 'year_range' => $request->year_range,
            'sort_order' => $request->sort_order ?? 0, 'active' => $request->boolean('active', true),
        ]);
        return back()->with('success', 'Model updated.');
    }

    public function modelDestroy(VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();
        return back()->with('success', 'Model deleted.');
    }

    // ── ENGINES ────────────────────────────────────────────────────────

    public function enginesIndex(VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel)
    {
        $engines = $vehicleModel->engines()->orderBy('sort_order')->get();
        return view('admin.vehicles.engines', compact('vehicleType', 'vehicleBrand', 'vehicleSeries', 'vehicleModel', 'engines'));
    }

    public function engineStore(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel)
    {
        $request->validate(['name' => 'required|string|max:150', 'displacement' => 'nullable|string|max:20', 'power' => 'nullable|string|max:30', 'fuel_type' => 'nullable|string|max:30', 'sort_order' => 'nullable|integer']);
        $vehicleModel->engines()->create([
            'name' => $request->name, 'displacement' => $request->displacement,
            'power' => $request->power, 'fuel_type' => $request->fuel_type,
            'sort_order' => $request->sort_order ?? 0, 'active' => true,
        ]);
        return back()->with('success', 'Engine added.');
    }

    public function engineUpdate(Request $request, VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel, VehicleEngine $vehicleEngine)
    {
        $request->validate(['name' => 'required|string|max:150', 'displacement' => 'nullable|string|max:20', 'power' => 'nullable|string|max:30', 'fuel_type' => 'nullable|string|max:30', 'sort_order' => 'nullable|integer']);
        $vehicleEngine->update([
            'name' => $request->name, 'displacement' => $request->displacement,
            'power' => $request->power, 'fuel_type' => $request->fuel_type,
            'sort_order' => $request->sort_order ?? 0, 'active' => $request->boolean('active', true),
        ]);
        return back()->with('success', 'Engine updated.');
    }

    public function engineDestroy(VehicleType $vehicleType, VehicleBrand $vehicleBrand, VehicleSeries $vehicleSeries, VehicleModel $vehicleModel, VehicleEngine $vehicleEngine)
    {
        $vehicleEngine->delete();
        return back()->with('success', 'Engine deleted.');
    }
}
