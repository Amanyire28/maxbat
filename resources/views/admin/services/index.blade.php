@extends('admin.layout')
@section('title','Services')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">All Services</span>
        <a href="{{ route('admin.services.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus"></i> Add Service</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Icon</th><th>Name</th><th>Description</th><th>Order</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>
                        <div style="width:38px;height:38px;border-radius:8px;background:rgba(91,200,0,0.12);border:1px solid rgba(91,200,0,0.25);display:flex;align-items:center;justify-content:center;color:var(--green);">
                            <i class="fa {{ $service->icon }}"></i>
                        </div>
                    </td>
                    <td style="font-weight:600;color:#fff;">{{ $service->name }}</td>
                    <td style="color:rgba(255,255,255,0.5);font-size:13px;max-width:300px;">{{ Str::limit($service->description, 70) }}</td>
                    <td style="color:rgba(255,255,255,0.5);">{{ $service->sort_order }}</td>
                    <td>
                        <span class="badge {{ $service->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $service->active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-ghost btn-sm"><i class="fa fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No services yet. <a href="{{ route('admin.services.create') }}" style="color:var(--green);">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $services->links() }}</div>
</div>
@endsection
