<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'icon'                => 'required|string|max:100',
            'description'         => 'nullable|string',
            'sort_order'          => 'nullable|integer',
            'active'              => 'nullable|boolean',
            'file_upload_enabled' => 'nullable|boolean',
            'file_types'          => 'nullable|string|max:500',
        ]);
        $data['active']              = $request->boolean('active', true);
        $data['file_upload_enabled'] = $request->boolean('file_upload_enabled');
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'icon'                => 'required|string|max:100',
            'description'         => 'nullable|string',
            'sort_order'          => 'nullable|integer',
            'active'              => 'nullable|boolean',
            'file_upload_enabled' => 'nullable|boolean',
            'file_types'          => 'nullable|string|max:500',
        ]);
        $data['active']              = $request->boolean('active', true);
        $data['file_upload_enabled'] = $request->boolean('file_upload_enabled');
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
