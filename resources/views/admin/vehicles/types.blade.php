@extends('admin.layout')
@section('title','Vehicle Database')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:26px;color:#fff;text-transform:uppercase;letter-spacing:1px;">Vehicle Database</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-top:4px;">Manage vehicle types → brands → series → models → engines</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

    {{-- ADD TYPE FORM --}}
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:1px;">
            <i class="fa fa-plus-circle" style="color:var(--green);margin-right:8px;"></i> Add Vehicle Type
        </h3>
        <form method="POST" action="{{ route('admin.vehicles.types.store') }}">
            @csrf
            <div class="form-grid" style="grid-template-columns:1fr auto;gap:12px;align-items:end;">
                <div class="form-group">
                    <label class="form-label">Type Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Car, SUV, Truck" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0" style="width:80px;">
                </div>
            </div>
            <button type="submit" class="btn btn-green" style="margin-top:14px;"><i class="fa fa-plus"></i> Add Type</button>
        </form>
    </div>

    {{-- TYPES LIST --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Vehicle Types</span>
            <span style="font-size:13px;color:rgba(255,255,255,0.4);">{{ $types->count() }} types</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Type</th><th>Brands</th><th>Order</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($types as $type)
                <tr>
                    <td style="font-weight:600;color:#fff;">{{ $type->name }}</td>
                    <td>
                        <a href="{{ route('admin.vehicles.brands.index', $type) }}" class="btn btn-ghost btn-sm">
                            {{ $type->brands_count }} brands <i class="fa fa-arrow-right"></i>
                        </a>
                    </td>
                    <td style="color:rgba(255,255,255,0.4);">{{ $type->sort_order }}</td>
                    <td>
                        <span class="badge {{ $type->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $type->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <button onclick="openEditType({{ $type->id }},'{{ addslashes($type->name) }}',{{ $type->sort_order }},{{ $type->active ? 1 : 0 }})" class="btn btn-ghost btn-sm"><i class="fa fa-pen"></i></button>
                        <form method="POST" action="{{ route('admin.vehicles.types.destroy', $type) }}" onsubmit="return confirm('Delete this type and all its data?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No vehicle types yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Edit modal --}}
<div id="editTypeModal" style="display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:28px;width:100%;max-width:400px;border-top:3px solid var(--green);">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;color:#fff;margin-bottom:20px;text-transform:uppercase;">Edit Vehicle Type</h3>
        <form id="editTypeForm" method="POST">
            @csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Name *</label>
                <input type="text" name="name" id="editTypeName" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" id="editTypeSortOrder" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom:20px;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <label class="toggle-switch"><input type="checkbox" name="active" id="editTypeActive" value="1"><span class="toggle-slider"></span></label>
                    <span class="form-label" style="margin:0;">Active</span>
                </label>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> Save</button>
                <button type="button" onclick="closeEditType()" class="btn btn-ghost">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditType(id, name, order, active) {
    document.getElementById('editTypeForm').action = '/admin/vehicles/types/' + id;
    document.getElementById('editTypeName').value = name;
    document.getElementById('editTypeSortOrder').value = order;
    document.getElementById('editTypeActive').checked = active === 1;
    document.getElementById('editTypeModal').style.display = 'flex';
}
function closeEditType() { document.getElementById('editTypeModal').style.display = 'none'; }
</script>
@endsection
