@extends('admin.layout')
@section('title', 'Videos')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">Posted Videos</span>
        <a href="{{ route('admin.videos.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus"></i> Add Video</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Video URL</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $video)
                @php
                    $thumb = null;
                    preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/ ]{11})/", $video->video_url, $matches);
                    if (isset($matches[1])) {
                        $thumb = "https://img.youtube.com/vi/{$matches[1]}/mqdefault.jpg";
                    }
                @endphp
                <tr>
                    <td>
                        @if($thumb)
                            <img src="{{ $thumb }}" style="width:72px;height:45px;object-fit:cover;border-radius:6px;border:1px solid rgba(255,255,255,0.1);">
                        @else
                            <div style="width:72px;height:45px;border-radius:6px;background:#2a2a2a;display:flex;align-items:center;justify-content:center;color:var(--green);font-size:16px;"><i class="fa fa-video"></i></div>
                        @endif
                    </td>
                    <td style="font-weight:600;color:#fff;">{{ $video->title }}</td>
                    <td style="color:var(--green);">{{ $video->category ?? 'General' }}</td>
                    <td>
                        <a href="{{ $video->video_url }}" target="_blank" style="color:rgba(255,255,255,0.6);text-decoration:underline;font-size:13px;">
                            {{ Str::limit($video->video_url, 40) }} <i class="fa fa-external-link-alt" style="font-size:10px;"></i>
                        </a>
                    </td>
                    <td>
                        <span class="badge {{ $video->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $video->active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-ghost btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" onsubmit="return confirm('Delete this video?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">
                        No videos posted yet. <a href="{{ route('admin.videos.create') }}" style="color:var(--green);">Add one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $videos->links() }}</div>
</div>
@endsection
