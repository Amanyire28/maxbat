@extends('admin.layout')
@section('title', $car->id ? 'Edit Car Listing' : 'Add Car Listing')
@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.cars-for-sale.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back to Listings</a>
</div>

<div class="form-card" style="max-width:800px;">
    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:22px;text-transform:uppercase;margin-bottom:24px;color:#fff;">
        {{ $car->id ? 'Edit Car Details' : 'Add New Car for Sale' }}
    </h3>

    <form method="POST" action="{{ $car->id ? route('admin.cars-for-sale.update', $car->id) : route('admin.cars-for-sale.store') }}" enctype="multipart/form-data">
        @csrf
        @if($car->id) @method('PUT') @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-grid form-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group">
                <label class="form-label">Make (Brand) *</label>
                <input type="text" name="make" class="form-control" value="{{ old('make', $car->make) }}" placeholder="e.g. Subaru" required>
            </div>
            <div class="form-group">
                <label class="form-label">Model *</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}" placeholder="e.g. Impreza WRX STI" required>
            </div>
            <div class="form-group">
                <label class="form-label">Year of Manufacture *</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $car->year) }}" placeholder="e.g. 2018" required min="1900" max="{{ date('Y') + 1 }}">
            </div>
            <div class="form-group">
                <label class="form-label">Price (UGX) *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $car->price) }}" placeholder="e.g. 45000000" required>
            </div>
            <div class="form-group">
                <label class="form-label">Mileage (km) *</label>
                <input type="number" name="mileage" class="form-control" value="{{ old('mileage', $car->mileage) }}" placeholder="e.g. 85000" required min="0">
            </div>
            <div class="form-group">
                <label class="form-label">Transmission *</label>
                <select name="transmission" class="form-control" required>
                    <option value="">Select Transmission</option>
                    <option value="Manual" {{ old('transmission', $car->transmission) === 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automatic" {{ old('transmission', $car->transmission) === 'Automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="Semi-Automatic" {{ old('transmission', $car->transmission) === 'Semi-Automatic' ? 'selected' : '' }}>Semi-Automatic</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Fuel Type *</label>
                <select name="fuel_type" class="form-control" required>
                    <option value="">Select Fuel</option>
                    <option value="Petrol" {{ old('fuel_type', $car->fuel_type) === 'Petrol' ? 'selected' : '' }}>Petrol</option>
                    <option value="Diesel" {{ old('fuel_type', $car->fuel_type) === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Hybrid" {{ old('fuel_type', $car->fuel_type) === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="Electric" {{ old('fuel_type', $car->fuel_type) === 'Electric' ? 'selected' : '' }}>Electric</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Engine Size <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
                <input type="text" name="engine_size" class="form-control" value="{{ old('engine_size', $car->engine_size) }}" placeholder="e.g. 2.5L Turbo">
            </div>
            <div class="form-group">
                <label class="form-label">Exterior Color <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $car->color) }}" placeholder="e.g. World Rally Blue">
            </div>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Description & Additional Features <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
            <textarea name="description" class="form-control" rows="5" placeholder="Highlight mechanical condition, modifications, service history, and custom specs…">{{ old('description', $car->description) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Main Photo *</label>
            @if($car->image)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('storage/'.$car->image) }}" style="height:100px;border-radius:8px;object-fit:cover;">
                    <span style="font-size:12px;color:rgba(255,255,255,0.4);margin-left:10px;">Current Main Photo</span>
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*" {{ $car->id ? '' : 'required' }}>
            <span style="font-size:12px;color:rgba(255,255,255,0.3);margin-top:4px;">Main cover image. Max 3MB. JPG, PNG, WebP.</span>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Gallery Photos <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
            
            @if($car->gallery && count($car->gallery) > 0)
                <div style="margin-bottom:14px;background:#222;padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.05);">
                    <label class="form-label" style="font-size:11px;color:var(--muted);">Current Gallery (Select checkbox on photo to DELETE it):</label>
                    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:8px;">
                        @foreach($car->gallery as $gImage)
                            <div style="position:relative;width:90px;height:65px;border-radius:4px;overflow:hidden;border:1px solid rgba(255,255,255,0.1);">
                                <img src="{{ asset('storage/'.$gImage) }}" style="width:100%;height:100%;object-fit:cover;">
                                <div style="position:absolute;top:2px;right:2px;background:rgba(0,0,0,0.7);padding:2px;border-radius:3px;display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_gallery_images[]" value="{{ $gImage }}" style="width:12px;height:12px;accent-color:var(--red);cursor:pointer;" title="Delete this image">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin-top:10px;display:flex;align-items:center;gap:6px;">
                        <input type="checkbox" name="replace_gallery" value="1" id="replace_gallery">
                        <label for="replace_gallery" style="font-size:12px;color:#ff6b6b;cursor:pointer;">Delete ALL current gallery photos and start fresh</label>
                    </div>
                </div>
            @endif
            
            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
            <span style="font-size:12px;color:rgba(255,255,255,0.3);margin-top:4px;">Upload multiple files. Hold Ctrl/Cmd to select multiple images. Max 3MB per image.</span>
        </div>

        <div class="form-group" style="margin-top:18px;flex-direction:row;align-items:center;gap:12px;">
            <label class="toggle-switch">
                <input type="checkbox" name="active" value="1" {{ old('active', $car->id ? $car->active : true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span style="font-size:14px;color:rgba(255,255,255,0.6);">Available for Sale (visible on website)</span>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> {{ $car->id ? 'Update Car listing' : 'List Car for Sale' }}</button>
            <a href="{{ route('admin.cars-for-sale.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection
