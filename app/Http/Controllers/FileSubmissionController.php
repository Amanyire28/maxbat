<?php

namespace App\Http\Controllers;

use App\Models\FileSubmission;
use App\Models\Service;
use Illuminate\Http\Request;

class FileSubmissionController extends Controller
{
    public function services()
    {
        $services = Service::where('active', true)
            ->where('file_upload_enabled', true)
            ->orderBy('sort_order')
            ->get(['id','name','file_types']);

        return response()->json($services);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'phone'            => 'required|string|max:30',
            'email'            => 'nullable|email|max:255',
            'vehicle_type_id'  => 'required|exists:vehicle_types,id',
            'vehicle_brand_id' => 'required|exists:vehicle_brands,id',
            'vehicle_series_id'=> 'required|exists:vehicle_series,id',
            'vehicle_model_id' => 'required|exists:vehicle_models,id',
            'vehicle_engine_id'=> 'required|exists:vehicle_engines,id',
            'chassis_no'       => 'required|string|max:100',
            'service_id'       => 'required|exists:services,id',
            'file_type'        => 'required|string|max:100',
            'notes'            => 'nullable|string|max:1000',
            'upload_file'      => 'required|file|max:51200|mimes:bin,hex,ori,org,zip,rar,7z,pdf,csv,xls,xlsx,txt,ecu,kess,ktag,frf,sgo',
        ]);

        $file = $request->file('upload_file');
        $path = $file->store('file_submissions', 'public');

        FileSubmission::create([
            'customer_name'    => $data['customer_name'],
            'phone'            => $data['phone'],
            'email'            => $data['email'] ?? null,
            'vehicle_type_id'  => $data['vehicle_type_id'],
            'vehicle_brand_id' => $data['vehicle_brand_id'],
            'vehicle_series_id'=> $data['vehicle_series_id'],
            'vehicle_model_id' => $data['vehicle_model_id'],
            'vehicle_engine_id'=> $data['vehicle_engine_id'],
            'chassis_no'       => $data['chassis_no'],
            'service_id'       => $data['service_id'],
            'file_type'        => $data['file_type'],
            'file_path'        => $path,
            'original_filename'=> $file->getClientOriginalName(),
            'file_size'        => round($file->getSize() / 1024, 1) . ' KB',
            'notes'            => $data['notes'] ?? null,
            'status'           => 'new',
        ]);

        return response()->json(['success' => true, 'message' => 'File submitted successfully! We will review it and get back to you within 24 hours.']);
    }
}
