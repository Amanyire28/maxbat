@extends('admin.layout')
@section('title','Brands — '.$vehicleType->name)
@section('content')

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:rgba(255,255,255,0.4);">
    <a href="{{ route('admin.vehicles.index') }}" style="color:var(--green);">Vehicle Types</a>
    <i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <span style="color:#fff;">{{ $vehicleType->name }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:1px;">
            <i class="fa fa-plus-circle" style="color:var(--green);margin-right:8px;"></i> Add Brand — {{ $vehicleType->name }}
        </h3>
        <form method="POST" action="{{ route('admin.vehicles.brands.store', $vehicleType) }}">
            @csrf
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Brand Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. BMW, Toyota" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>
            <button type="submit" class="btn btn-green"><i class="fa fa-plus"></i> Add Brand</button>
        </form>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">{{ $vehicleType->name }} Brands</span>
            <span style="font-size:13px;color:rgba(255,255,255,0.4);">{{ $brands->count() }} brands</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Brand</th><th>Series</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($brands as $brand)
                <tr>
                    <td style="font-weight:600;color:#fff;">{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('admin.vehicles.series.index', [$vehicleType, $brand]) }}" class="btn btn-ghost btn-sm">
                            {{ $brand->series_count }} series <i class="fa fa-arrow-right"></i>
                        </a>
                    </td>
                    <td><span class="badge {{ $brand->active ? 'badge-completed' : 'badge-cancelled' }}">{{ $brand->active ? 'Active' : 'Inactive' }}</span></td>
                    <td style="display:flex;gap:6px;">
                        <button onclick="openEditBrand({{ $brand->id }},'{{ addslashes($brand->name) }}',{{ $brand->sort_order }},{{ $brand->active ? 1 : 0 }})" class="btn btn-ghost btn-sm"><i class="fa fa-pen"></i></button>
                        <form method="POST" action="{{ route('admin.vehicles.brands.destroy', [$vehicleType, $brand]) }}" onsubmit="return confirm('Delete brand and all its data?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No brands yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editBrandModal" style="display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:28px;width:100%;max-width:400px;border-top:3px solid var(--green);">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;color:#fff;margin-bottom:20px;text-transform:uppercase;">Edit Brand</h3>
        <form id="editBrandForm" method="POST">
            @csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Name *</label><input type="text" name="name" id="editBrandName" class="form-control" required></div>
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Sort Order</label><input type="number" name="sort_order" id="editBrandOrder" class="form-control"></div>
            <div class="form-group" style="margin-bottom:20px;"><label style="display:flex;align-items:center;gap:10px;cursor:pointer;"><label class="toggle-switch"><input type="checkbox" name="active" id="editBrandActive" value="1"><span class="toggle-slider"></span></label><span class="form-label" style="margin:0;">Active</span></label></div>
            <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-green"><i class="fa fa-save"></i> Save</button><button type="button" onclick="closeEditBrand()" class="btn btn-ghost">Cancel</button></div>
        </form>
    </div>
</div>
<script>
function openEditBrand(id, name, order, active) {
    document.getElementById('editBrandForm').action = '/admin/vehicles/types/{{ $vehicleType->id }}/brands/' + id;
    document.getElementById('editBrandName').value = name;
    document.getElementById('editBrandOrder').value = order;
    document.getElementById('editBrandActive').checked = active === 1;
    document.getElementById('editBrandModal').style.display = 'flex';
}
function closeEditBrand() { document.getElementById('editBrandModal').style.display = 'none'; }
</script>
@endsection
