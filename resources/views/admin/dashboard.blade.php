@extends('admin.layout')
@section('title','Dashboard')
@section('content')

<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fa fa-envelope"></i></div>
        <div><div class="stat-num">{{ $stats['inquiries'] }}</div><div class="stat-label">Total Inquiries</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fa fa-bell"></i></div>
        <div><div class="stat-num">{{ $stats['new_inquiries'] }}</div><div class="stat-label">New Inquiries</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa fa-file-upload"></i></div>
        <div><div class="stat-num">{{ $stats['file_submissions'] }}</div><div class="stat-label">File Submissions</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fa fa-bell"></i></div>
        <div><div class="stat-num">{{ $stats['new_files'] }}</div><div class="stat-label">New Files</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa fa-shopping-bag"></i></div>
        <div><div class="stat-num">{{ $stats['products'] }}</div><div class="stat-label">Products</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fa fa-tools"></i></div>
        <div><div class="stat-num">{{ $stats['services'] }}</div><div class="stat-label">Services</div></div>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">Recent Inquiries</span>
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-right"></i> View All</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Phone</th><th>Vehicle</th><th>Service</th><th>Status</th><th>Date</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_inquiries as $inq)
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
                    <td><a href="{{ route('admin.inquiries.show', $inq) }}" class="btn btn-ghost btn-sm"><i class="fa fa-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No inquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
