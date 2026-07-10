@extends('admin.layout')
@section('title','File Submissions')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title"><i class="fa fa-file-upload" style="color:var(--green);margin-right:8px;"></i> File Submissions</span>
        <form method="GET" class="search-bar">
            <input type="text" name="search" class="search-input" placeholder="Name, phone, chassis…" value="{{ request('search') }}">
            <select name="status" class="form-control" style="width:150px;padding:9px 14px;">
                <option value="">All Status</option>
                <option value="new"       {{ request('status')==='new'?'selected':'' }}>New</option>
                <option value="reviewing" {{ request('status')==='reviewing'?'selected':'' }}>Reviewing</option>
                <option value="completed" {{ request('status')==='completed'?'selected':'' }}>Completed</option>
                <option value="rejected"  {{ request('status')==='rejected'?'selected':'' }}>Rejected</option>
            </select>
            <button type="submit" class="btn btn-ghost btn-sm"><i class="fa fa-search"></i></button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.file-submissions.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-times"></i></a>
            @endif
        </form>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Customer</th><th>Vehicle</th><th>Service</th><th>File Type</th><th>File</th><th>Status</th><th>Date</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $sub)
                <tr>
                    <td style="color:rgba(255,255,255,0.3)">{{ $sub->id }}</td>
                    <td>
                        <div style="font-weight:600;color:#fff;">{{ $sub->customer_name }}</div>
                        <div style="font-size:12px;color:rgba(255,255,255,0.4);">{{ $sub->phone }}</div>
                    </td>
                    <td>
                        <div style="color:#fff;">{{ $sub->vehicle_summary }}</div>
                        <div style="font-size:12px;color:var(--green);">{{ $sub->chassis_no }}</div>
                    </td>
                    <td style="color:rgba(255,255,255,0.7);">{{ $sub->service->name ?? '—' }}</td>
                    <td style="color:rgba(255,255,255,0.7);">{{ $sub->file_type }}</td>
                    <td>
                        <a href="{{ route('admin.file-submissions.download', $sub) }}"
                           class="btn btn-ghost btn-sm" style="gap:5px;">
                            <i class="fa fa-download" style="color:var(--green);"></i>
                            <span style="font-size:11px;color:rgba(255,255,255,0.5);">{{ $sub->file_size }}</span>
                        </a>
                    </td>
                    <td>
                        <span class="badge badge-{{ $sub->status === 'new' ? 'new' : ($sub->status === 'reviewing' ? 'progress' : ($sub->status === 'completed' ? 'completed' : 'cancelled')) }}">
                            {{ ucfirst($sub->status) }}
                        </span>
                    </td>
                    <td style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $sub->created_at->format('d M Y') }}</td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.file-submissions.show', $sub) }}" class="btn btn-ghost btn-sm"><i class="fa fa-eye"></i></a>
                        <form method="POST" action="{{ route('admin.file-submissions.destroy', $sub) }}" onsubmit="return confirm('Delete this submission?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No file submissions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $submissions->withQueryString()->links() }}</div>
</div>
@endsection
