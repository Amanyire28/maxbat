@extends('admin.layout')
@section('title','Inquiries')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">All Inquiries</span>
        <form method="GET" class="search-bar">
            <input type="text" name="search" class="search-input" placeholder="Search name, phone, email…" value="{{ request('search') }}">
            <select name="status" class="form-control" style="width:150px;padding:9px 14px;">
                <option value="">All Status</option>
                <option value="new"         {{ request('status')==='new'?'selected':'' }}>New</option>
                <option value="in_progress" {{ request('status')==='in_progress'?'selected':'' }}>In Progress</option>
                <option value="completed"   {{ request('status')==='completed'?'selected':'' }}>Completed</option>
                <option value="cancelled"   {{ request('status')==='cancelled'?'selected':'' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-ghost btn-sm"><i class="fa fa-search"></i></button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-times"></i></a>
            @endif
        </form>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Name</th><th>Phone</th><th>Vehicle</th><th>Service</th><th>Status</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inq)
                <tr>
                    <td style="color:rgba(255,255,255,0.3);">{{ $inq->id }}</td>
                    <td style="font-weight:600;color:#fff;">{{ $inq->name }}</td>
                    <td>{{ $inq->phone }}</td>
                    <td style="color:rgba(255,255,255,0.6);">{{ $inq->vehicle_make }} {{ $inq->vehicle_model }}</td>
                    <td style="color:rgba(255,255,255,0.6);">{{ $inq->service ?? '—' }}</td>
                    <td>
                        <span class="badge badge-{{ $inq->status === 'new' ? 'new' : ($inq->status === 'in_progress' ? 'progress' : ($inq->status === 'completed' ? 'completed' : 'cancelled')) }}">
                            {{ ucfirst(str_replace('_',' ',$inq->status)) }}
                        </span>
                    </td>
                    <td style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $inq->created_at->format('d M Y') }}</td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.inquiries.show', $inq) }}" class="btn btn-ghost btn-sm"><i class="fa fa-eye"></i></a>
                        <form method="POST" action="{{ route('admin.inquiries.destroy', $inq) }}" onsubmit="return confirm('Delete this inquiry?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No inquiries found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $inquiries->withQueryString()->links() }}</div>
</div>
@endsection
