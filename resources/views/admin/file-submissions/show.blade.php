@extends('admin.layout')
@section('title','File Submission #'.$fileSubmission->id)

@push('styles')
<style>
    .sub-grid { display:grid; grid-template-columns:1fr; gap:20px; }
    @media(min-width:900px){ .sub-grid { grid-template-columns:1.5fr 1fr; } }
    .detail-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .detail-val { color:#fff; font-size:15px; margin-top:4px; }
    .detail-val a { color:var(--green); }
    .detail-val.muted { color:rgba(255,255,255,0.55); }
    .detail-val.accent { color:var(--green); font-weight:600; }
</style>
@endpush

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.file-submissions.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    <span style="color:rgba(255,255,255,0.35);font-size:14px;">File Submission #{{ $fileSubmission->id }}</span>
    <span class="badge badge-{{ $fileSubmission->status === 'new' ? 'new' : ($fileSubmission->status === 'reviewing' ? 'progress' : ($fileSubmission->status === 'completed' ? 'completed' : 'cancelled')) }}">
        {{ ucfirst($fileSubmission->status) }}
    </span>
</div>

<div class="sub-grid">

    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;text-transform:uppercase;margin-bottom:22px;color:#fff;letter-spacing:1px;">
            Submission Details
        </h3>

        <div style="margin-bottom:22px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,0.07);">
            <div class="form-label" style="margin-bottom:8px;">Vehicle Information</div>
            <div class="detail-row">
                @if($fileSubmission->vehicleType)
                <div class="detail-item"><div class="form-label">Type</div><div class="detail-val">{{ $fileSubmission->vehicleType->name }}</div></div>
                <div class="detail-item"><div class="form-label">Brand</div><div class="detail-val">{{ $fileSubmission->vehicleBrand->name ?? '—' }}</div></div>
                <div class="detail-item"><div class="form-label">Series</div><div class="detail-val">{{ $fileSubmission->vehicleSeries->name ?? '—' }}</div></div>
                <div class="detail-item"><div class="form-label">Model</div><div class="detail-val">{{ $fileSubmission->vehicleModel->name ?? '—' }}{{ $fileSubmission->vehicleModel?->year_range ? ' ('.$fileSubmission->vehicleModel->year_range.')' : '' }}</div></div>
                <div class="detail-item" style="grid-column:span 2"><div class="form-label">Engine</div><div class="detail-val accent">{{ $fileSubmission->vehicleEngine->name ?? '—' }}</div></div>
                @else
                <div class="detail-item"><div class="form-label">Brand</div><div class="detail-val">{{ $fileSubmission->car_brand }}</div></div>
                <div class="detail-item"><div class="form-label">Model</div><div class="detail-val">{{ $fileSubmission->car_model }}</div></div>
                @endif
                <div class="detail-item" style="grid-column:span 2"><div class="form-label">Chassis Number</div><div class="detail-val accent">{{ $fileSubmission->chassis_no }}</div></div>
            </div>
        </div>

        <div style="margin-bottom:22px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,0.07);">
            <div class="form-label" style="margin-bottom:8px;">Customer Information</div>
            <div class="detail-row">
                <div class="detail-item"><div class="form-label">Name</div><div class="detail-val">{{ $fileSubmission->customer_name }}</div></div>
                <div class="detail-item"><div class="form-label">Phone</div><div class="detail-val"><a href="tel:{{ $fileSubmission->phone }}">{{ $fileSubmission->phone }}</a></div></div>
                <div class="detail-item" style="grid-column:span 2"><div class="form-label">Email</div><div class="detail-val">{{ $fileSubmission->email ? '<a href="mailto:'.$fileSubmission->email.'">'.$fileSubmission->email.'</a>' : '—' }}</div></div>
            </div>
        </div>

        <div style="margin-bottom:22px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,0.07);">
            <div class="form-label" style="margin-bottom:8px;">File Information</div>
            <div class="detail-row">
                <div class="detail-item"><div class="form-label">Service</div><div class="detail-val accent">{{ $fileSubmission->service->name ?? '—' }}</div></div>
                <div class="detail-item"><div class="form-label">File Type</div><div class="detail-val">{{ $fileSubmission->file_type }}</div></div>
                <div class="detail-item"><div class="form-label">Filename</div><div class="detail-val muted" style="font-size:13px;">{{ $fileSubmission->original_filename }}</div></div>
                <div class="detail-item"><div class="form-label">Size</div><div class="detail-val muted">{{ $fileSubmission->file_size }}</div></div>
            </div>
        </div>

        @if($fileSubmission->notes)
        <div>
            <div class="form-label">Notes from Customer</div>
            <div style="margin-top:8px;background:#1e1e1e;border:1px solid rgba(255,255,255,0.07);border-radius:8px;padding:14px;color:rgba(255,255,255,0.75);font-size:14px;line-height:1.75;">
                {{ $fileSubmission->notes }}
            </div>
        </div>
        @endif

        <div style="margin-top:20px;color:rgba(255,255,255,0.4);font-size:13px;">
            Submitted: {{ $fileSubmission->created_at->format('d M Y, H:i') }}
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:16px;">

        <div class="form-card">
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;margin-bottom:16px;color:#fff;letter-spacing:1px;">Download File</h3>
            <a href="{{ route('admin.file-submissions.download', $fileSubmission) }}"
               class="btn btn-green" style="width:100%;justify-content:center;">
                <i class="fa fa-download"></i> Download {{ $fileSubmission->original_filename }}
            </a>
            <div style="margin-top:10px;font-size:12px;color:rgba(255,255,255,0.35);text-align:center;">{{ $fileSubmission->file_size }}</div>
        </div>

        <div class="form-card">
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;margin-bottom:16px;color:#fff;letter-spacing:1px;">Update Status</h3>
            <form method="POST" action="{{ route('admin.file-submissions.status', $fileSubmission) }}">
                @csrf @method('PATCH')
                <div style="margin-bottom:14px;">
                    <select name="status" class="form-control">
                        <option value="new"       {{ $fileSubmission->status==='new'?'selected':'' }}>New</option>
                        <option value="reviewing" {{ $fileSubmission->status==='reviewing'?'selected':'' }}>Reviewing</option>
                        <option value="completed" {{ $fileSubmission->status==='completed'?'selected':'' }}>Completed</option>
                        <option value="rejected"  {{ $fileSubmission->status==='rejected'?'selected':'' }}>Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;"><i class="fa fa-save"></i> Save Status</button>
            </form>
        </div>

        <div class="form-card">
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;margin-bottom:16px;color:#fff;letter-spacing:1px;">Quick Actions</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $fileSubmission->phone) }}?text={{ urlencode('Hello '.$fileSubmission->customer_name.', this is MaxBat Automobil regarding your submitted '.$fileSubmission->file_type.' for your '.$fileSubmission->car_brand.' '.$fileSubmission->car_model.'. ') }}"
                   target="_blank" class="btn btn-ghost" style="justify-content:center;">
                    <i class="fab fa-whatsapp" style="color:#25D366;"></i> Reply on WhatsApp
                </a>
                <a href="tel:{{ $fileSubmission->phone }}" class="btn btn-ghost" style="justify-content:center;">
                    <i class="fa fa-phone" style="color:var(--green);"></i> Call Customer
                </a>
                <form method="POST" action="{{ route('admin.file-submissions.destroy', $fileSubmission) }}"
                      onsubmit="return confirm('Delete this submission and its file?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

