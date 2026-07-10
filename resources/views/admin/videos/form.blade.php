@extends('admin.layout')
@section('title', $video->id ? 'Edit Video' : 'Add Video')
@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.videos.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back to Videos</a>
</div>

<div class="form-card" style="max-width:720px;">
    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:22px;text-transform:uppercase;margin-bottom:24px;color:#fff;">
        {{ $video->id ? 'Edit Video Details' : 'Add New Video' }}
    </h3>

    <form method="POST" action="{{ $video->id ? route('admin.videos.update', $video) : route('admin.videos.store') }}">
        @csrf
        @if($video->id) @method('PUT') @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-grid form-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
            <div class="form-group">
                <label class="form-label">Video Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $video->title) }}" placeholder="e.g. Stage 3 Golf R Dyno Run" required>
            </div>
            <div class="form-group">
                <label class="form-label">Category / Tag <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $video->category) }}" placeholder="e.g. Dyno Run, ECU Tuning, Review">
            </div>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">YouTube or Video URL *</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $video->video_url) }}" placeholder="e.g. https://www.youtube.com/watch?v=dQw4w9WgXcQ" required>
            <span style="font-size:12px;color:rgba(255,255,255,0.3);margin-top:4px;">Supports standard YouTube, Vimeo, or generic video link URLs.</span>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Video Description <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
            <textarea name="description" class="form-control" rows="4" placeholder="Briefly describe what this video showcases…">{{ old('description', $video->description) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;flex-direction:row;align-items:center;gap:12px;">
            <label class="toggle-switch">
                <input type="checkbox" name="active" value="1" {{ old('active', $video->id ? $video->active : true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span style="font-size:14px;color:rgba(255,255,255,0.6);">Active (visible on website)</span>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> {{ $video->id ? 'Update Video' : 'Publish Video' }}</button>
            <a href="{{ route('admin.videos.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection
