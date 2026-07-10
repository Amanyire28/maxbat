@extends('admin.layout')
@section('title', $career->id ? 'Edit Job Posting' : 'Add Job Posting')
@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.careers.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back to Listings</a>
</div>

<div class="form-card" style="max-width:720px;">
    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:22px;text-transform:uppercase;margin-bottom:24px;color:#fff;">
        {{ $career->id ? 'Edit Job Posting' : 'Add New Job Posting' }}
    </h3>

    <form method="POST" action="{{ $career->id ? route('admin.careers.update', $career) : route('admin.careers.store') }}">
        @csrf
        @if($career->id) @method('PUT') @endif

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
                <label class="form-label">Job Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $career->title) }}" placeholder="e.g. Senior Tuner & ECU Specialist" required>
            </div>
            <div class="form-group">
                <label class="form-label">Job Type *</label>
                <select name="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Full-time" {{ old('type', $career->type) === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('type', $career->type) === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('type', $career->type) === 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('type', $career->type) === 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Location *</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $career->location) }}" placeholder="e.g. Belgrade workshop (on-site)" required>
            </div>
            <div class="form-group">
                <label class="form-label">Salary Range <span style="color:rgba(255,255,255,0.3);">(optional)</span></label>
                <input type="text" name="salary" class="form-control" value="{{ old('salary', $career->salary) }}" placeholder="e.g. Negotiable, UGX 1.5M - 2.5M">
            </div>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Job Description *</label>
            <textarea name="description" class="form-control" rows="6" placeholder="Provide a summary of the role, responsibilities, and team context…" required>{{ old('description', $career->description) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label class="form-label">Job Requirements * <span style="color:rgba(255,255,255,0.3);">(one per line recommended)</span></label>
            <textarea name="requirements" class="form-control" rows="6" placeholder="List qualifications, technical skills, and experience required…" required>{{ old('requirements', $career->requirements) }}</textarea>
        </div>

        <div class="form-group" style="margin-top:18px;flex-direction:row;align-items:center;gap:12px;">
            <label class="toggle-switch">
                <input type="checkbox" name="active" value="1" {{ old('active', $career->id ? $career->active : true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span style="font-size:14px;color:rgba(255,255,255,0.6);">Active (visible on website)</span>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="btn btn-green"><i class="fa fa-save"></i> {{ $career->id ? 'Update Job Posting' : 'Publish Job Posting' }}</button>
            <a href="{{ route('admin.careers.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection
