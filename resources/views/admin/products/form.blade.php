@extends('admin.layout')
@section('title', isset($product->id) ? 'Edit Product' : 'Add Product')
@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.products.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="form-card" style="max-width:720px;">
    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:22px;text-transform:uppercase;margin-bottom:24px;color:#fff;">
        {{ isset($product->id) ? 'Edit Product' : 'Add New Product' }}
    </h3>

    <form method="POST"
          action="{{ isset($product->id) ? route('admin.products.update', $product) : route('admin.products.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($product->id)) @method('PUT') @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-grid form-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group">
                <label class="form-label">Product Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" placeholder="e.g. Premium Engine Oil" required>
            </div>
            <div class="form-group">
                <label class="form-label">Category *</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}" placeholder="e.g. Engine Care" required>
            </div>
            <div class="form-group">
                <label class="form-label">Price *</label>
                <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="e.g. From UGX 45,000" required>
            </div>
            <div class="form-group">
                <label class="form-label">Badge <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
                <input type="text" name="badge" class="form-control" value="{{ old('badge', $product->badge) }}" placeholder="e.g. Best Seller, New, Hot">
            </div>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Product description…">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Product Image</label>
            @if(isset($product->id) && $product->image)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('storage/'.$product->image) }}" style="height:80px;border-radius:8px;object-fit:cover;">
                    <span style="font-size:12px;color:rgba(255,255,255,0.4);margin-left:10px;">Current image</span>
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <span style="font-size:12px;color:rgba(255,255,255,0.3);margin-top:4px;">Max 2MB. JPG, PNG, WebP.</span>
        </div>

        <div class="form-group" style="margin-top:18px;flex-direction:row;align-items:center;gap:12px;">
            <label class="toggle-switch">
                <input type="checkbox" name="active" value="1" {{ old('active', $product->active ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span style="font-size:14px;color:rgba(255,255,255,0.6);">Active (visible on website)</span>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> {{ isset($product->id) ? 'Update Product' : 'Create Product' }}</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection

