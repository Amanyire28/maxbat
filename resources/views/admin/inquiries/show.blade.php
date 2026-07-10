@extends('admin.layout')
@section('title','Inquiry #'.$inquiry->id)

@push('styles')
<style>
    .inquiry-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }
    @media(min-width: 900px) {
        .inquiry-grid { grid-template-columns: 1.5fr 1fr; }
    }
    .detail-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .detail-item .form-label { margin-bottom: 5px; }
    .detail-val { color: #fff; font-size: 15px; margin-top: 4px; }
    .detail-val a { color: var(--green); }
    .detail-val.muted { color: rgba(255,255,255,0.55); }
    .detail-val.accent { color: var(--green); font-weight: 600; }
    .message-box {
        margin-top: 8px;
        background: #1e1e1e;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 8px;
        padding: 14px 16px;
        color: rgba(255,255,255,0.75);
        font-size: 14px;
        line-height: 1.75;
    }
</style>
@endpush

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-ghost btn-sm">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <span style="color:rgba(255,255,255,0.35);font-size:14px;">Inquiry #{{ $inquiry->id }}</span>
    <span class="badge badge-{{ $inquiry->status === 'new' ? 'new' : ($inquiry->status === 'in_progress' ? 'progress' : ($inquiry->status === 'completed' ? 'completed' : 'cancelled')) }}">
        {{ ucfirst(str_replace('_',' ', $inquiry->status)) }}
    </span>
</div>

<div class="inquiry-grid">

    {{-- LEFT: Customer details --}}
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;text-transform:uppercase;margin-bottom:22px;color:#fff;letter-spacing:1px;">
            Customer Details
        </h3>

        <div class="detail-row">
            <div class="detail-item">
                <div class="form-label">Full Name</div>
                <div class="detail-val">{{ $inquiry->name }}</div>
            </div>
            <div class="detail-item">
                <div class="form-label">Phone</div>
                <div class="detail-val">
                    <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                </div>
            </div>
            <div class="detail-item">
                <div class="form-label">Email</div>
                <div class="detail-val">
                    @if($inquiry->email)
                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                    @else
                        <span class="muted">—</span>
                    @endif
                </div>
            </div>
            <div class="detail-item">
                <div class="form-label">Submitted</div>
                <div class="detail-val muted">{{ $inquiry->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="detail-item">
                <div class="form-label">Vehicle Make</div>
                <div class="detail-val">{{ $inquiry->vehicle_make ?? '—' }}</div>
            </div>
            <div class="detail-item">
                <div class="form-label">Vehicle Model</div>
                <div class="detail-val">{{ $inquiry->vehicle_model ?? '—' }}</div>
            </div>
        </div>

        <div style="margin-top:20px;">
            <div class="form-label">Service Required</div>
            <div class="detail-val accent" style="margin-top:6px;">{{ $inquiry->service ?? '—' }}</div>
        </div>

        @if($inquiry->message)
        <div style="margin-top:20px;">
            <div class="form-label">Message</div>
            <div class="message-box">{{ $inquiry->message }}</div>
        </div>
        @endif
    </div>

    {{-- RIGHT: Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Update Status --}}
        <div class="form-card">
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;margin-bottom:16px;color:#fff;letter-spacing:1px;">
                Update Status
            </h3>
            <form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}">
                @csrf @method('PATCH')
                <div style="margin-bottom:14px;">
                    <select name="status" class="form-control">
                        <option value="new"         {{ $inquiry->status==='new'         ? 'selected' : '' }}>New</option>
                        <option value="in_progress" {{ $inquiry->status==='in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ $inquiry->status==='completed'   ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled"   {{ $inquiry->status==='cancelled'   ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;">
                    <i class="fa fa-save"></i> Save Status
                </button>
            </form>
        </div>

        {{-- Quick Actions --}}
        <div class="form-card">
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;margin-bottom:16px;color:#fff;letter-spacing:1px;">
                Quick Actions
            </h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}?text={{ urlencode('Hello '.$inquiry->name.', this is MaxBat Automobil regarding your inquiry about '.$inquiry->service.'. ') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="btn btn-ghost" style="justify-content:center;">
                    <i class="fab fa-whatsapp" style="color:#25D366;"></i> Reply on WhatsApp
                </a>
                <a href="tel:{{ $inquiry->phone }}" class="btn btn-ghost" style="justify-content:center;">
                    <i class="fa fa-phone" style="color:var(--green);"></i> Call Customer
                </a>
                @if($inquiry->email)
                <a href="mailto:{{ $inquiry->email }}?subject=Re: Your MaxBat Inquiry&body=Hello {{ $inquiry->name }},"
                   class="btn btn-ghost" style="justify-content:center;">
                    <i class="fa fa-envelope" style="color:var(--green);"></i> Send Email
                </a>
                @endif
                <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}"
                      onsubmit="return confirm('Delete this inquiry permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                        <i class="fa fa-trash"></i> Delete Inquiry
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

