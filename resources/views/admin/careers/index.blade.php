@extends('admin.layout')
@section('title', 'Careers')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">Job Postings</span>
        <a href="{{ route('admin.careers.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus"></i> Add Job Posting</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Salary Range</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($careers as $career)
                <tr>
                    <td style="font-weight:600;color:#fff;">{{ $career->title }}</td>
                    <td>
                        <span class="badge badge-new">{{ $career->type }}</span>
                    </td>
                    <td>{{ $career->location }}</td>
                    <td style="color:var(--green);">{{ $career->salary ?? 'Not Specified' }}</td>
                    <td>
                        <span class="badge {{ $career->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $career->active ? 'Active' : 'Draft' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.careers.edit', $career) }}" class="btn btn-ghost btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" onsubmit="return confirm('Delete this job posting?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">
                        No job postings yet. <a href="{{ route('admin.careers.create') }}" style="color:var(--green);">Add one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $careers->links() }}</div>
</div>
@endsection
