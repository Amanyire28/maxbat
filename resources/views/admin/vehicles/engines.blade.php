@extends('admin.layout')
@section('title','Engines — '.$vehicleModel->name)
@section('content')

<div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:rgba(255,255,255,0.4);">
    <a href="{{ route('admin.vehicles.index') }}" style="color:var(--green);">Types</a><i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('admin.vehicles.brands.index', $vehicleType) }}" style="color:var(--green);">{{ $vehicleType->name }}</a><i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('admin.vehicles.series.index', [$vehicleType,$vehicleBrand]) }}" style="color:var(--green);">{{ $vehicleBrand->name }}</a><i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('admin.vehicles.models.index', [$vehicleType,$vehicleBrand,$vehicleSeries]) }}" style="color:var(--green);">{{ $vehicleSeries->name }}</a><i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <span style="color:#fff;">{{ $vehicleModel->name }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:1px;">
            <i class="fa fa-plus-circle" style="color:var(--green);margin-right:8px;"></i> Add Engine
        </h3>
        <form method="POST" action="{{ route('admin.vehicles.engines.store', [$vehicleType,$vehicleBrand,$vehicleSeries,$vehicleModel]) }}">
            @csrf
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Engine Name *</label><input type="text" name="name" class="form-control" placeholder="e.g. 2.0T 184hp" required></div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Displacement</label><input type="text" name="displacement" class="form-control" placeholder="e.g. 2.0L"></div>
                <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Power</label><input type="text" name="power" class="form-control" placeholder="e.g. 184hp"></div>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Fuel Type</label>
                <select name="fuel_type" class="form-control">
                    <option value="">— Select —</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Electric">Electric</option>
                    <option value="LPG">LPG</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
            <button type="submit" class="btn btn-green"><i class="fa fa-plus"></i> Add Engine</button>
        </form>
    </div>

    <div class="table-card">
        <div class="table-card-header"><span class="table-card-title">{{ $vehicleModel->name }} Engines</span><span style="font-size:13px;color:rgba(255,255,255,0.4);">{{ $engines->count() }}</span></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Engine</th><th>Displacement</th><th>Power</th><th>Fuel</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($engines as $eng)
                <tr>
                    <td style="font-weight:600;color:#fff;">{{ $eng->name }}</td>
                    <td style="color:rgba(255,255,255,0.5);font-size:13px;">{{ $eng->displacement ?? '—' }}</td>
                    <td style="color:rgba(255,255,255,0.5);font-size:13px;">{{ $eng->power ?? '—' }}</td>
                    <td>
                        @if($eng->fuel_type)
                        <span class="badge {{ $eng->fuel_type === 'Diesel' ? 'badge-progress' : ($eng->fuel_type === 'Electric' ? 'badge-new' : 'badge-completed') }}">{{ $eng->fuel_type }}</span>
                        @else —
                        @endif
                    </td>
                    <td><span class="badge {{ $eng->active ? 'badge-completed' : 'badge-cancelled' }}">{{ $eng->active ? 'Active' : 'Inactive' }}</span></td>
                    <td style="display:flex;gap:6px;">
                        <button onclick="openEdit({{ $eng->id }},'{{ addslashes($eng->name) }}','{{ addslashes($eng->displacement ?? '') }}','{{ addslashes($eng->power ?? '') }}','{{ addslashes($eng->fuel_type ?? '') }}',{{ $eng->sort_order }},{{ $eng->active ? 1 : 0 }})" class="btn btn-ghost btn-sm"><i class="fa fa-pen"></i></button>
                        <form method="POST" action="{{ route('admin.vehicles.engines.destroy', [$vehicleType,$vehicleBrand,$vehicleSeries,$vehicleModel,$eng]) }}" onsubmit="return confirm('Delete this engine?')">
                            @csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No engines yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editModal" style="display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:28px;width:100%;max-width:460px;border-top:3px solid var(--green);">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;color:#fff;margin-bottom:20px;text-transform:uppercase;">Edit Engine</h3>
        <form id="editForm" method="POST">@csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Name *</label><input type="text" name="name" id="eName" class="form-control" required></div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Displacement</label><input type="text" name="displacement" id="eDisp" class="form-control"></div>
                <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Power</label><input type="text" name="power" id="ePower" class="form-control"></div>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Fuel Type</label>
                <select name="fuel_type" id="eFuel" class="form-control">
                    <option value="">— Select —</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Electric">Electric</option>
                    <option value="LPG">LPG</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Sort Order</label><input type="number" name="sort_order" id="eOrder" class="form-control"></div>
            <div class="form-group" style="margin-bottom:20px;"><label style="display:flex;align-items:center;gap:10px;cursor:pointer;"><label class="toggle-switch"><input type="checkbox" name="active" id="eActive" value="1"><span class="toggle-slider"></span></label><span class="form-label" style="margin:0;">Active</span></label></div>
            <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-green"><i class="fa fa-save"></i> Save</button><button type="button" onclick="closeEdit()" class="btn btn-ghost">Cancel</button></div>
        </form>
    </div>
</div>
<script>
const baseUrl = '/admin/vehicles/types/{{ $vehicleType->id }}/brands/{{ $vehicleBrand->id }}/series/{{ $vehicleSeries->id }}/models/{{ $vehicleModel->id }}/engines/';
function openEdit(id, name, disp, power, fuel, order, active) {
    document.getElementById('editForm').action = baseUrl + id;
    document.getElementById('eName').value = name;
    document.getElementById('eDisp').value = disp;
    document.getElementById('ePower').value = power;
    document.getElementById('eFuel').value = fuel;
    document.getElementById('eOrder').value = order;
    document.getElementById('eActive').checked = active === 1;
    document.getElementById('editModal').style.display = 'flex';
}
function closeEdit() { document.getElementById('editModal').style.display = 'none'; }
</script>
@endsection
