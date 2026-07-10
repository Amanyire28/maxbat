@extends('admin.layout')
@section('title','Series — '.$vehicleBrand->name)
@section('content')

<div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:rgba(255,255,255,0.4);">
    <a href="{{ route('admin.vehicles.index') }}" style="color:var(--green);">Types</a>
    <i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('admin.vehicles.brands.index', $vehicleType) }}" style="color:var(--green);">{{ $vehicleType->name }}</a>
    <i class="fa fa-chevron-right" style="font-size:10px;"></i>
    <span style="color:#fff;">{{ $vehicleBrand->name }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:1px;">
            <i class="fa fa-plus-circle" style="color:var(--green);margin-right:8px;"></i> Add Series — {{ $vehicleBrand->name }}
        </h3>
        <form method="POST" action="{{ route('admin.vehicles.series.store', [$vehicleType, $vehicleBrand]) }}">
            @csrf
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Series Name *</label><input type="text" name="name" class="form-control" placeholder="e.g. 3 Series, Land Cruiser" required></div>
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
            <button type="submit" class="btn btn-green"><i class="fa fa-plus"></i> Add Series</button>
        </form>
    </div>

    <div class="table-card">
        <div class="table-card-header"><span class="table-card-title">{{ $vehicleBrand->name }} Series</span><span style="font-size:13px;color:rgba(255,255,255,0.4);">{{ $seriesList->count() }}</span></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Series</th><th>Models</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($seriesList as $series)
                <tr>
                    <td style="font-weight:600;color:#fff;">{{ $series->name }}</td>
                    <td><a href="{{ route('admin.vehicles.models.index', [$vehicleType, $vehicleBrand, $series]) }}" class="btn btn-ghost btn-sm">{{ $series->models_count }} models <i class="fa fa-arrow-right"></i></a></td>
                    <td><span class="badge {{ $series->active ? 'badge-completed' : 'badge-cancelled' }}">{{ $series->active ? 'Active' : 'Inactive' }}</span></td>
                    <td style="display:flex;gap:6px;">
                        <button onclick="openEdit({{ $series->id }},'{{ addslashes($series->name) }}',{{ $series->sort_order }},{{ $series->active ? 1 : 0 }})" class="btn btn-ghost btn-sm"><i class="fa fa-pen"></i></button>
                        <form method="POST" action="{{ route('admin.vehicles.series.destroy', [$vehicleType, $vehicleBrand, $series]) }}" onsubmit="return confirm('Delete series and all its data?')">
                            @csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No series yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editModal" style="display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:28px;width:100%;max-width:400px;border-top:3px solid var(--green);">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;color:#fff;margin-bottom:20px;text-transform:uppercase;">Edit Series</h3>
        <form id="editForm" method="POST">@csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Name *</label><input type="text" name="name" id="eName" class="form-control" required></div>
            <div class="form-group" style="margin-bottom:14px;"><label class="form-label">Sort Order</label><input type="number" name="sort_order" id="eOrder" class="form-control"></div>
            <div class="form-group" style="margin-bottom:20px;"><label style="display:flex;align-items:center;gap:10px;cursor:pointer;"><label class="toggle-switch"><input type="checkbox" name="active" id="eActive" value="1"><span class="toggle-slider"></span></label><span class="form-label" style="margin:0;">Active</span></label></div>
            <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-green"><i class="fa fa-save"></i> Save</button><button type="button" onclick="closeEdit()" class="btn btn-ghost">Cancel</button></div>
        </form>
    </div>
</div>
<script>
const baseUrl = '/admin/vehicles/types/{{ $vehicleType->id }}/brands/{{ $vehicleBrand->id }}/series/';
function openEdit(id, name, order, active) {
    document.getElementById('editForm').action = baseUrl + id;
    document.getElementById('eName').value = name;
    document.getElementById('eOrder').value = order;
    document.getElementById('eActive').checked = active === 1;
    document.getElementById('editModal').style.display = 'flex';
}
function closeEdit() { document.getElementById('editModal').style.display = 'none'; }
</script>
@endsection
