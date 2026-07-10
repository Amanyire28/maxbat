@extends('admin.layout')
@section('title', isset($service->id) ? 'Edit Service' : 'Add Service')
@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.services.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="form-card" style="max-width:640px;">
    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:22px;text-transform:uppercase;margin-bottom:24px;color:#fff;">
        {{ isset($service->id) ? 'Edit Service' : 'Add New Service' }}
    </h3>

    <form method="POST"
          action="{{ isset($service->id) ? route('admin.services.update', $service) : route('admin.services.store') }}">
        @csrf
        @if(isset($service->id)) @method('PUT') @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group">
                <label class="form-label">Service Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" placeholder="e.g. ECU Tuning" required>
            </div>
            <div class="form-group">
                <label class="form-label">Font Awesome Icon *</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? 'fa-tools') }}" placeholder="e.g. fa-microchip" required>
                <span style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:4px;">
                    Use any <a href="https://fontawesome.com/icons" target="_blank" style="color:var(--green);">Font Awesome</a> class, e.g. fa-key, fa-cogs
                </span>
            </div>
        </div>

        @if(isset($service->icon))
        <div style="margin-top:6px;display:flex;align-items:center;gap:10px;color:rgba(255,255,255,0.5);font-size:13px;">
            <div style="width:36px;height:36px;border-radius:8px;background:rgba(91,200,0,0.12);border:1px solid rgba(91,200,0,0.25);display:flex;align-items:center;justify-content:center;color:var(--green);">
                <i class="fa {{ $service->icon }}" id="iconPreview"></i>
            </div>
            <span>Current icon preview</span>
        </div>
        @endif

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Brief description of this service…">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Sort Order <span style="color:rgba(255,255,255,0.3);">(lower = first)</span></label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0" style="width:160px;">
        </div>

        <div class="form-group" style="margin-top:18px;flex-direction:row;align-items:center;gap:12px;">
            <label class="toggle-switch">
                <input type="checkbox" name="active" value="1" {{ old('active', $service->active ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span style="font-size:14px;color:rgba(255,255,255,0.6);">Active (visible on website)</span>
        </div>

        {{-- FILE UPLOAD SECTION --}}
        <div style="margin-top:28px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.07);">
            <h4 style="font-family:'Bebas Neue',sans-serif;font-size:16px;text-transform:uppercase;letter-spacing:1px;color:#fff;margin-bottom:16px;">
                <i class="fa fa-upload" style="color:var(--green);margin-right:8px;"></i> File Upload Feature
            </h4>

            <div class="form-group" style="flex-direction:row;align-items:center;gap:12px;margin-bottom:18px;">
                <label class="toggle-switch">
                    <input type="checkbox" name="file_upload_enabled" id="fileUploadToggle" value="1"
                        {{ old('file_upload_enabled', $service->file_upload_enabled ?? false) ? 'checked' : '' }}
                        onchange="document.getElementById('fileTypesSection').style.display=this.checked?'block':'none'">
                    <span class="toggle-slider"></span>
                </label>
                <span style="font-size:14px;color:rgba(255,255,255,0.6);">Enable File Upload button for this service on the website</span>
            </div>

            <div id="fileTypesSection" style="display:{{ old('file_upload_enabled', $service->file_upload_enabled ?? false) ? 'block' : 'none' }};">
                <div class="form-group">
                    <label class="form-label">File Type Options
                        <span style="color:rgba(255,255,255,0.3);font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;"> — comma-separated</span>
                    </label>
                    <input type="text" name="file_types" class="form-control"
                        value="{{ old('file_types', $service->file_types) }}"
                        placeholder="e.g. ECU File, Gearbox File, Original File, Stock File">
                    <span style="font-size:12px;color:rgba(255,255,255,0.3);margin-top:6px;display:block;">
                        Each entry becomes a selectable option in the file upload dropdown on the website.
                    </span>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> {{ isset($service->id) ? 'Update Service' : 'Create Service' }}</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection

